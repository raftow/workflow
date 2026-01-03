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
                        'color' => 'white',
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
                // find the best available employee
                $strict = ($this->getVal('employee_id') > 0);
                $orgunit_id = $this->getVal('orgunit_id');
                $workflow_scope_id = $this->getVal('workflow_scope_id');
                list($best_employee_id, $wkfEmpl, $allList, $log) = WorkflowEmployee::getBestAvailableEmployee($orgunit_id, $workflow_scope_id, 0, $strict);
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
                                return array($this->tm('No suitable available employee for the request') . ' ID = ' . $this->id, '', $log);
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
                $objme = AfwSession::getUserConnected();
                $you_dont_have_rights = $objme->translateMessage('CANT_DO_THIS', $lang);

                if ((!$objme) or (!$objme->isAdmin()))
                        $response_data_format = "data = '';\n";
                else
                        $response_data_format = '';
                return "<div id='wreq-$myId-comments' class='wcomments'>
                                <label>$add_comment_label</label>
                                $inputStage
                                <div class='subject'>$inputSubject</div>
                                <div class='comment'>$inputComment</div>
                                <div class='ppsave'><input type='button' name='addwrcomment' id='addwrcomment' request='$myId' class='fa greenbtn wizardbtn' value='&nbsp;$add_title&nbsp;' style='margin-right: 5px;'></div>
                        </div>
                        <script>
                                function addWorkflowRequestComment()
                                {
                                the_idreq = $myId;
                                the_stage = \$('#comment_workflow_stage_id').val();
                                the_subject = \$('#request_comment_subject_id').val();
                                the_comment = \$('#comment').val();
                                \$.ajax({
                                        type:'POST',
                                        url:'../workflow/api/wkfaddcomment.php',                                           
                                        data:{idreq:the_idreq, stage:the_stage, subject:the_subject, comment:the_comment},
                                        dataType: 'json',
                                        success: function(data)
                                        {
                                                console.log('idreq='+idreq+' stage='+stage+' subject='+subject+' comment='+comment+' wkfaddcomment response = ', data);
                                                if(data.status=='success')
                                                {
                                                        \$('#span-'+mod+'-'+cls+'-'+idobj+'-'+col).text(data.aff);                    
                                                }
                                                else
                                                {
                                                        $response_data_format
                                                        swal('$you_dont_have_rights ['+data.message+']'); // 
                                                        return [false, null];
                                                }
                                        }

                                });
                                }

                                \$(document).ready(function(){
                                        \$(\"#addwrcomment\").click(function()
                                        {                            
                                                addWorkflowRequestComment();                                        
                                        );
                                });

                        </script>
                        ";
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

        public static function assignEmployeeForNonAssigned($silent = false, $lang = 'ar', $limit = '200')
        {
                $server_db_prefix = AfwSession::currentDBPrefix();
                $obj = new WorkflowRequest();

                $obj->setForce('employee_id', 0);
                $obj->setForce('status_comment', 'assignEmployeeForNonAssigned-doing-reset');
                $obj->where('me.orgunit_id > 0 
                        and 
                                        (
                                                (
                                                        me.employee_id > 0 
                                                        and me.employee_id not in (select employee_id from ' . $server_db_prefix . "workflow.workflow_employee we where we.orgunit_id = me.orgunit_id and me.active='Y')
                                                ) 
                                                or me.employee_id is null
                                        ) 
                        and done != 'Y'");
                $obj->update(false);
                unset($obj);

                $obj = new WorkflowRequest();
                $obj->where("employee_id=0 and orgunit_id > 0 and done != 'Y'");
                $reqList = $obj->loadMany($limit);

                $errors_arr = array();
                $infos_arr = array();

                foreach ($reqList as $reqItem) {
                        /** @var WorkflowRequest $reqItem */
                        list($err, $info) = $reqItem->assignBestAvailableEmployee($lang, $pbm = true);

                        if ($err)
                                $errors_arr[] = $err;
                        if ($info)
                                $infos_arr[] = $info;
                }

                $nb_errs = count($errors_arr);

                $infos_arr[] = 'assign done for ' . count($reqList) . " request(s) with $nb_errs error(s)";

                if ((!$silent) and (count($errors_arr) > 0)) {
                        AfwSession::pushError(implode('<br>', $errors_arr));
                }

                if ((!$silent) and (count($infos_arr) > 0)) {
                        AfwSession::pushInformation(implode('<br>', $infos_arr));
                }

                return AfwFormatHelper::pbm_result($errors_arr, $infos_arr);
        }

        /*
         * public static function assignSupervisorForNonAssigned($reset = false, $silent = false, $lang = 'ar', $limit = '200', $jobContext = null)
         * {
         *         $errors_arr = array();
         *         $infos_arr = array();
         *         $tech_arr = array();
         *         $warn_arr = array();
         *         $nb_errs = 0;
         *         $nb_done = 0;
         *
         *         $obj = new Request();
         *         if ($jobContext)
         *                 AfwBatch::print_comment('----------------------- JOB Context : ' . $jobContext . ' -----------------------');
         *         if ($reset) {
         *                 $obj->setForce('supervisor_id', 0);
         *                 $obj->setForce('employee_id', 0);
         *                 $obj->setForce('status_comment', 'assignSupervisorForNonAssigned-with-reset');
         *                 $obj->where('employee_id = 0 and status_id not in (' . self::$REQUEST_STATUSES_NO_NEED_ASSIGN . ')');  //  or (supervisor_id = 1917 and employee_id = 1791) //  or (orgunit_id = " . self::$CRM_CENTER_ID . ")
         *                 $nb_rows_rest = $obj->update(false);
         *                 $warn_arr[] = "$nb_rows_rest request(s) assignment has been reset";
         *         } elseif ($jobContext)
         *                 AfwBatch::print_error("$jobContext >> assignSupervisorForNonAssigned->reset should be true for the moment");
         *
         *         $silent = false;
         *
         *         $obj->select('supervisor_id', 0);
         *         $obj->where('status_id not in (' . self::$REQUEST_STATUSES_NO_NEED_ASSIGN . ')');
         *
         *         $reqList = $obj->loadMany($limit);
         *         $total = count($reqList);
         *         $doing = 0;
         *         foreach ($reqList as $reqId => $reqItem) {
         *                 $doing++;
         *                 if ($jobContext)
         *                         AfwBatch::print_comment('----------------------- JOB Context : ' . $jobContext . " assignBestAvailableSupervisor For Request ID = $reqId ($doing / $total) -----------------------");
         *                 list($err, $info) = $reqItem->assignBestAvailableSupervisor($lang, $pbm = true, $commit = true, $re_distribution = false);
         *
         *                 if ($err) {
         *                         $tech_arr[] = 'Error : ' . $err;
         *                         $nb_errs++;
         *                         if ($jobContext)
         *                                 AfwBatch::print_error(">> $jobContext >> Error : .$err");
         *                 } else
         *                         $nb_done++;
         *                 if ($info)
         *                         $tech_arr[] = $info;
         *         }
         *
         *         $infos_arr[] = "done : $nb_done , errors : $nb_errs";
         *
         *         if ((!$silent) and (count($errors_arr) > 0)) {
         *                 AfwSession::pushError(implode('<br>', $errors_arr));
         *         }
         *
         *         if ((!$silent) and (count($infos_arr) > 0)) {
         *                 AfwSession::pushInformation(implode('<br>', $infos_arr));
         *         }
         *
         *         return AfwFormatHelper::pbm_result($errors_arr, $infos_arr, $warn_arr, "<br>\n", $tech_arr);
         * }
         */
}
