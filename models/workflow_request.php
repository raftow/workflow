<?php
class WorkflowRequest extends WorkflowObject
{
        public static $DATABASE = '';
        public static $MODULE = 'workflow';
        public static $TABLE = 'workflow_request';
        public static $DB_STRUCTURE = null;
        // public static $copypast = true;

        private $originalObject = null;

        public static $PUB_METHODS = array(
                'assignRequest' => array(
                        'title' => 'تعيين [item]',
                        'confirmation_needed' => false,
                        'confirmation_warning' => '',
                        'confirmation_question' => ''
                ),
        );

        public function __construct()
        {
                parent::__construct('workflow_request', 'id', 'workflow');
                WorkflowWorkflowRequestAfwStructure::initInstance($this);
        }

        public static function loadById($id)
        {
                $obj = new WorkflowRequest();

                if ($obj->load($id)) {
                        return $obj;
                } else
                        return null;
        }

        public static function loadByMainIndex($workflow_applicant_id, $workflow_model_id, $create_obj_if_not_found = false)
        {
                if (!$workflow_applicant_id)
                        throw new AfwRuntimeException('loadByMainIndex : workflow_applicant_id is mandatory field');
                if (!$workflow_model_id)
                        throw new AfwRuntimeException('loadByMainIndex : workflow_model_id is mandatory field');

                $obj = new WorkflowRequest();
                $obj->select('workflow_applicant_id', $workflow_applicant_id);
                $obj->select('workflow_model_id', $workflow_model_id);

                if ($obj->load()) {
                        if ($create_obj_if_not_found) {
                                if (!$obj->getVal('request_date'))
                                        $obj->set('request_date', AfwDateHelper::currentHijriDate());
                                $obj->activate();
                        }

                        return $obj;
                } elseif ($create_obj_if_not_found) {
                        $obj->set('workflow_applicant_id', $workflow_applicant_id);
                        $obj->set('workflow_model_id', $workflow_model_id);
                        $obj->set('request_date', AfwDateHelper::currentHijriDate());
                        $obj->set('done', 'N');
                        $obj->insertNew();
                        if (!$obj->id)
                                return null;  // means beforeInsert rejected insert operation
                        $obj->is_new = true;
                        return $obj;
                } else
                        return null;
        }

        public function getDisplay($lang = 'ar')
        {
                return $this->getDefaultDisplay($lang);
        }

        public function stepsAreOrdered()
        {
                return false;
        }

        public static function inboxSqlCond($employee_id, $prefix = 'me.')
        {
                return $prefix . "employee_id='$employee_id' and " . $prefix . "done != 'Y'";
        }

        public static function inboxCountFor($employee_id)
        {
                $obj = new WorkflowRequest();
                $sql = self::inboxSqlCond($employee_id, $prefix = '');
                $obj->where($sql);
                return $obj->count();
        }

        protected function afwCall($name, $arguments)
        {
                if (substr($name, 0, 13) == 'assignRequest') {
                        $employeeId = intval(substr($name, 13));
                        return $this->assignRequest($employeeId, $arguments[0]);
                }

                if (substr($name, 0, 13) == 'calcDiv_step_') {
                        $step = intval(substr($name, 13));
                        return $this->calcDiv_step($step, $arguments[0], 'Y');
                }

                return false;
                // the above return should be keeped if not treated
        }

        public function assignRequest($employeeId, $lang = 'ar')
        {
                if ((!$employeeId) and $this->getVal('employee_id') > 0)
                        throw new AfwRuntimeException('strange attempt to unassign the request ID=' . $this->id);
                if (!$employeeId)
                        return array('', 'attempt to unassign the request nothing-done');

                $this->set('employee_id', $employeeId);

                // $objOrgunit = null;
                // $objEmployee = $this->het("employee_id");
                $this->set('assign_date', AfwDateHelper::currentHijriDate());
                $this->set('assign_time', date('H:i:s'));
                $this->commit();
                $status_comment = date('H:i:s') . ': تم اسناد الطلب [' . $this->id . "] للموظف(ة) $employeeId " . $this->showAttribute('employee_id');
                return array('', $status_comment);
        }

        public function getEmployees($excludeCurrentAssigned = false)
        {
                if (!$this->getVal('orgunit_id') or !$this->getVal('workflow_scope_id'))
                        return array();

                if (!$excludeCurrentAssigned)
                        $except_employee_id = 0;
                else
                        $except_employee_id = $this->getVal('employee_id');

                return WorkflowEmployee::getEmployeeList($this->getVal('orgunit_id'), $this->getVal('workflow_scope_id'), $except_employee_id);  // $this->getVal("employee_id")
        }

        public function getMethodTitle($methodName, $lang = 'ar')
        {
                return $this->tm(self::$PUB_METHODS[$methodName]['title'], $lang);
        }

        public function getMethodTooltip($methodName, $lang = 'ar')
        {
                return $this->tm(self::$PUB_METHODS[$methodName]['tooltip'], $lang);
        }

        protected function getPublicMethods()
        {
                global $lang;

                $objme = AfwSession::getUserConnected();
                $log = '';
                $pbms = array();

                $color = 'green';
                $title_ar = 'تعيين الموظف الأقل عبئا';
                $methodName = 'assignBestAvailableEmployee';
                $pbms[AfwStringHelper::hzmEncode($methodName)] =
                        array('METHOD' => $methodName, 'COLOR' => $color, 'LABEL_AR' => $title_ar,
                                'ADMIN-ONLY' => true, 'BF-ID' => '',
                                'STEP' => $this->stepOfAttribute('employee_id'));

                $employeesList = $this->getEmployees(true);
                // $orgunit_id = $this->getVal('orgunit_id');
                // die("rafik dyn orgunit_id=$orgunit_id employeesList=" . var_export($employeesList, true));
                foreach (self::$PUB_METHODS as $methodName0 => $publicDynamicMethodProps) {
                        $pbms = AfwDynamicPublicMethodHelper::splitMethodWithItems($pbms, $publicDynamicMethodProps, $methodName0, $this, $log, $employeesList);
                }

                // die('rafik dyn pbms=' . var_export($pbms, true));

                return $pbms;
        }

        public function assignBestAvailableEmployee($lang = 'ar', $pbm = true)
        {
                // find the best available supervisor
                $strict = ($this->getVal('employee_id') > 0);
                $orgunit_id = $this->getVal('orgunit_id');
                list($best_employee_id, $wkfEmpl, $allList, $log) = WorkflowEmployee::getBestAvailableEmployee($orgunit_id, 0, $strict);
                // $wkfRes = array("best" => $best_employee_id, "res" => $wkfEmpl, 'all' => $allList);
                // die("<pre>CrmEmployee::assignBestAvailableEmployee() returned object : ". var_export($wkfRes, true)."</pre>");

                $wkfEmplObj = $wkfEmpl['obj'];

                // assign this Request to this supervisor
                $emplObj = null;
                if ($wkfEmplObj) {
                        $wkfEmplObj->assignMeOnWorkflowRequest($this, $lang);
                        $emplObj = $wkfEmplObj->hetEmployee();
                }
                // else die("<pre>CrmEmployee::assignBestAvailableEmployee() returned object : ". var_export($crmRes, true)."</pre>");

                if ($pbm) {
                        if ($emplObj)
                                return array('', $this->tm('request has beeen assigned to ') . $emplObj->getDisplay($lang), $log);
                        elseif ($strict) {
                                $emplObj = $this->het('employee_id');
                                return array('', $this->tm('This request already assigned to ') . $emplObj->getDisplay($lang), $log);
                        } else
                                return array($this->tm('no more available employees in the system') . " ORG-ID = $orgunit_id", '', $log);
                }

                return $emplObj;
        }

        public function calcCandidateFullName($what = 'value')
        {
                $lang = AfwLanguageHelper::getGlobalLanguage();

                $appObj = $this->het('workflow_applicant_id');
                if (!$appObj)
                        return '??????';
                return $appObj->getVal("first_name_$lang") . ' ' . $appObj->getVal("father_name_$lang") . ' ' . $appObj->getVal("last_name_$lang");
        }

        public function loadOriginalObject()
        {
                if (!$this->orginalObject) {
                        $modelObj = $this->het('workflow_model_id');
                        if (!$modelObj)
                                return ['No model for this request', null];

                        $moduleObj = $modelObj->het('workflow_module_id');
                        if (!$moduleObj)
                                return ['No module for this request', null];

                        $lookup_code = $moduleObj->getVal('lookup_code');
                        if (!$lookup_code)
                                return ['No code for the module of this request', null];

                        $moduleCode = strtolower($lookup_code);

                        AfwAutoLoader::addModule($moduleCode);

                        $moduleWorkflowServiceClass = AfwStringHelper::firstCharUpper($moduleCode) . 'WorkflowService';

                        $sessionObj = $this->het('workflow_session_id');
                        if (!$sessionObj)
                                return ['No session for this request', null];
                        ;

                        // $external_code = $sessionObj->getVal("external_code")

                        $appObj = $this->het('workflow_applicant_id');
                        if (!$appObj)
                                return ['No applicant for this request', null];

                        list($this->orginalObject, $keyLookup) = $moduleWorkflowServiceClass::loadOriginalObject($appObj, $sessionObj, $modelObj, $this);
                }

                return ['', $this->orginalObject, $keyLookup];
        }

        public function calcCandidateInfo($what = 'value')
        {
                $lang = AfwLanguageHelper::getGlobalLanguage();

                list($error, $objOriginal, $keyLookup) = $this->loadOriginalObject();

                if (!$objOriginal)
                        return "not found Original-Object looked up with ($keyLookup) : $error";

                return $objOriginal->calcCandidateInfo($what);
        }

        public function calcCategory($what = 'value')
        {
                $lang = AfwLanguageHelper::getGlobalLanguage();
                $appObj = $this->het('workflow_applicant_id');
                $idn = $appObj->getVal('idn');
                $name = $this->calcCandidateFullName($what);

                $info = $this->calcCandidateInfo($what);

                $myId = $this->id;

                return "<div id='wreq-$myId-category' class='wcategory'>
                                <span class='idn'>$idn</span>
                                <span class='fname'>$name</span>
                                <span class='wrinfo'>$info</span>
                        </div>";
        }

        public function calcFormComments($what = 'value')
        {
                $lang = AfwLanguageHelper::getGlobalLanguage();
                $obj = new WorkflowRequestComment();
                $obj->set('workflow_request_id', $this->id);
                $obj->set('workflow_stage_id', $this->getVal('workflow_stage_id'));
                list(
                        $inputStage,
                ) = AfwInputHelper::hidden_input('comment_workflow_stage_id', null, $this->getVal('workflow_stage_id'), $obj);
                $request_comment_subject_id = 0;
                $currstep = $_REQUEST['currstep'];
                if ($currstep <= 2)
                        $request_comment_subject_id = 1;
                elseif ($currstep <= 4)
                        $request_comment_subject_id = 2;
                elseif ($currstep <= 6)
                        $request_comment_subject_id = 3;

                $inputSubject = AfwInputHelper::simpleEditInputForAttribute('request_comment_subject_id', $request_comment_subject_id, null, $obj);
                $inputComment = AfwInputHelper::simpleEditInputForAttribute('comment', '', null, $obj);
                $add_title = AfwLanguageHelper::translateKeyword('ADD', $lang);
                $add_comment_label = $this->tm('Add comment', $lang);
                $myId = $this->id;
                return "<div id='wreq-$myId-comments' class='wcomments'>
                                <label>$add_comment_label</label>
                                $inputStage
                                <div class='subject'>$inputSubject</div>
                                <div class='comment'>$inputComment</div>
                                <div class='ppsave'><input type='button' name='addwrcomment' id='addwrcomment' request='$myId' class='popup-save fa greenbtn wizardbtn' value='&nbsp;$add_title&nbsp;' style='margin-right: 5px;'></div>
                        </div>";
        }

        public function shouldBeCalculatedField($attribute)
        {
                if ($attribute == 'mobile')
                        return true;
                if ($attribute == 'email')
                        return true;
                if ($attribute == 'country_id')
                        return true;
                if ($attribute == 'category')
                        return true;

                if ($attribute == 'gender_enum')
                        return true;

                if ($attribute == 'passeport_num')
                        return true;
                return false;
        }

        public function calcDiv_step($step, $what = 'value')
        {
                $lang = AfwLanguageHelper::getGlobalLanguage();

                list($error, $objOriginal, $keyLookup) = $this->loadOriginalObject();

                if (!$objOriginal)
                        return "not found Original-Object looked up with ($keyLookup) : $error";

                return $objOriginal->calcDivForWorkflowStep($step, $what);
        }
}
