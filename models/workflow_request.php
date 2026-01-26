<?php
class WorkflowRequest extends WorkflowObject
{
        public static $DATABASE = '';
        public static $MODULE = 'workflow';
        public static $TABLE = 'workflow_request';
        public static $DB_STRUCTURE = null;
        // public static $copypast = true;

        private $originalObject = null;

        public function __construct()
        {
                parent::__construct('workflow_request', 'id', 'workflow');
                WorkflowWorkflowRequestAfwStructure::initInstance($this);
        }

        public static $STATS_CONFIG = array(
                "wr0001" => array(
                        "STATS_WHERE" => "active = 'Y'", //  and request_date between [date_start_stats] and [date_end_stats]
                        // "URL_SETTINGS" => "main.php?Main_Page=afw_mode_edit.php&cl=CrmOrgunit&id=80&currmod=crm&currstep=5",
                        "DISABLE-VH" => true,
                        "FOOTER_TITLES" => true,
                        "FOOTER_SUM" => true,
                        "GROUP_SEP" => ".",
                        "GROUP_COLS" => array(
                                0 => array("COLUMN" => "workflow_scope_id", "DISPLAY-FORMAT" => "decode", "FOOTER_SUM_TITLE" => "الإجمــالـي"),
                        ),
                        "DISPLAY_COLS" => array(
                                1 => array("COLUMN" => "in_status_1",  "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "in_status_1",  "FOOTER_SUM" => true),
                                2 => array("COLUMN" => "in_status_2",  "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "in_status_2",  "FOOTER_SUM" => true),
                                3 => array("COLUMN" => "in_status_3",  "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "in_status_3",  "FOOTER_SUM" => true),
                                4 => array("COLUMN" => "in_status_4",  "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "in_status_4",  "FOOTER_SUM" => true),
                                5 => array("COLUMN" => "in_status_5",  "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "in_status_5",  "FOOTER_SUM" => true),
                                6 => array("COLUMN" => "in_status_6",  "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "in_status_6",  "FOOTER_SUM" => true),
                                7 => array("COLUMN" => "in_status_7",  "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "in_status_7",  "FOOTER_SUM" => true),
                                8 => array("COLUMN" => "in_status_8",  "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "in_status_8",  "FOOTER_SUM" => true),
                                9 => array("COLUMN" => "in_status_9",  "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "in_status_9",  "FOOTER_SUM" => true),
                                10 => array("COLUMN" => "in_status_10", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "in_status_10", "FOOTER_SUM" => true),
                                11 => array("COLUMN" => "in_status_11", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "in_status_11", "FOOTER_SUM" => true),
                                12 => array("COLUMN" => "in_status_12", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "in_status_12", "FOOTER_SUM" => true),
                                13 => array("COLUMN" => "in_status_13", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "in_status_13", "FOOTER_SUM" => true),
                                14 => array("COLUMN" => "in_status_14", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "in_status_14", "FOOTER_SUM" => true),
                                15 => array("COLUMN" => "in_status_15", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "in_status_15", "FOOTER_SUM" => true),
                                16 => array("COLUMN" => "in_status_16", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "in_status_16", "FOOTER_SUM" => true),
                                17 => array("COLUMN" => "in_status_17", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "in_status_17", "FOOTER_SUM" => true),
                                18 => array("COLUMN" => "in_status_18", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "in_status_18", "FOOTER_SUM" => true),
                                19 => array("COLUMN" => "in_status_19", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "in_status_19", "FOOTER_SUM" => true),
                                20 => array("COLUMN" => "in_status_20", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "in_status_20", "FOOTER_SUM" => true),
                                21 => array("COLUMN" => "in_status_21", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "in_status_21", "FOOTER_SUM" => true),
                                22 => array("COLUMN" => "in_status_22", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "in_status_22", "FOOTER_SUM" => true),
                                23 => array("COLUMN" => "in_status_23", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "in_status_23", "FOOTER_SUM" => true),
                        ),

                        "FORMULA_COLS" => array(
                                //0 => array("SHOW-NAME"=>"perf", "METHOD"=>"getPerf"),
                        ),

                        /*"OPTIONS" => array(
                                "perf"=> array('count_request' => true, 'request_done' => true, 'request_late' => true, 'request_ongoing' => true, 'perf'=>true),
                                      ),*/
                        // "SUPER_HEADER"=>array(0=>array("colspan"=>3, "title"=>""), 1=>array("colspan"=>2, "title"=>"year_36"), 2=>array("colspan"=>2, "title"=>"year_37"),
                        //                      3=>array("colspan"=>2, "title"=>"year_38"), 4=>array("colspan"=>2, "title"=>"year_39"), 5=>array("colspan"=>2, "title"=>"year_40"), ),

                ),
        );

        public static $PUB_METHODS = array(
                'assignRequest' => array(
                        'title' => 'تحويل الطلب إلى [item]',
                        'color' => 'random',
                        'confirmation_needed' => false,
                        'confirmation_warning' => '',
                        'confirmation_question' => '',
                        'itemsMethod' => 'getEmployees',
                        'roles' => "workflow/393",
                        'title-length' => "72",
                ),


                'runTransition' => array(
                        'title' => '[item]',
                        'mgroup' => 'admission decision',
                        'confirmation_needed' => false,
                        'confirmation_warning' => '',
                        'confirmation_question' => '',
                        'itemsMethod' => 'getMyTransitions',
                        'title-length' => "72",
                ),
        );



        public static function loadById($id)
        {
                $obj = new WorkflowRequest();

                if ($obj->load($id)) {
                        return $obj;
                } else
                        return null;
        }

        public static function allPrepareInterviewBookingIfNeeded()
        {
                $err_arr = [];
                $inf_arr = [];
                $war_arr = [];
                $tech_arr = [];
                $obj = new WorkflowRequest();
                // $obj->select_visibilite_horizontale();
                $objList = $obj->loadMany();
                /**
                 * @var WorkflowRequest $objItem
                 */
                $nb_updated = 0;
                foreach ($objList as $objItem) {
                        list($err, $inf, $war, $tech) = $objItem->prepareInterviewBookingIfNeeded();

                        if ($err) $err_arr[] = "$objItem : " . $err;
                        elseif ($inf) {
                                $nb_updated++;
                                // $inf_arr[] = "$student : ".$inf;
                        }
                        if ($war) $war_arr[] = "$objItem : " . $war;
                        if ($tech) $tech_arr[] = $tech;
                }

                return AfwFormatHelper::pbm_result($err_arr, $inf_arr, $war_arr, "<br>\n", $tech_arr);
        }

        public static function allGetOriginalData()
        {
                $err_arr = [];
                $inf_arr = [];
                $war_arr = [];
                $tech_arr = [];
                $obj = new WorkflowRequest();
                // $obj->select_visibilite_horizontale();
                $objList = $obj->loadMany();
                /**
                 * @var WorkflowRequest $objItem
                 */
                $nb_updated = 0;
                foreach ($objList as $objItem) {
                        list($err, $inf, $war, $tech) = $objItem->getOriginalData();

                        if ($err) $err_arr[] = "$objItem : " . $err;
                        elseif ($inf) {
                                $nb_updated++;
                                // $inf_arr[] = "$student : ".$inf;
                        }
                        if ($war) $war_arr[] = "$objItem : " . $war;
                        if ($tech) $tech_arr[] = $tech;
                }

                return AfwFormatHelper::pbm_result($err_arr, $inf_arr, $war_arr, "<br>\n", $tech_arr);
        }

        /**
         * @return WorkflowRequest
         */

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



                if (substr($name, 0, 13) == 'runTransition') {
                        $transitionId = intval(substr($name, 13));
                        return $this->runTransition($transitionId, $arguments[0]);
                }

                if (substr($name, 0, 13) == 'assignRequest') {
                        $employeeId = intval(substr($name, 13));
                        return $this->assignRequest($employeeId, $arguments[0]);
                }

                if (substr($name, 0, 13) == 'calcDiv_step_') {
                        $step = intval(substr($name, 13));
                        return $this->calcDiv_step($step, $arguments[0], 'Y');
                }

                if (substr($name, 0, 18) == 'approveProgramWith') {
                        $transitionId = intval(substr($name, 18));
                        list($error, $objOriginal, $keyLookup) = $this->loadOriginalObject();
                        if (!$objOriginal or $error) return ["Failed to load Original Object : $error", ""];
                        return $objOriginal->approveProgramWith($transitionId, $arguments[0]);
                }

                return false;
                // the above return should be keeped if not treated
        }

        public function disApproveProgram($lang = 'ar')
        {
                list($error, $objOriginal, $keyLookup) = $this->loadOriginalObject();
                if (!$objOriginal or $error) return ["Failed to load Original Object : $error", ""];
                return $objOriginal->disApproveProgram($lang);
        }


        public function getMyTransitions($onlyForAuthenticatedEmployee = false)
        {
                if ($onlyForAuthenticatedEmployee) {
                        $wEmployeeMe = WorkflowEmployee::getAuthenticatedEmployeeObject($this->getVal('orgunit_id'));
                        if (!$wEmployeeMe) return array(); // die("No user authenticated !!!!"); //
                        $employeeRolesArray = explode(",", trim($wEmployeeMe->getVal("wrole_mfk"), ","));
                } else {
                        $employeeRolesArray = null;
                }


                $obj = new WorkflowTransition();
                $obj->select('workflow_model_id', $this->getVal('workflow_model_id'));
                $obj->select('initial_stage_id', $this->getVal('workflow_stage_id'));
                $obj->select('initial_status_id', $this->getVal('workflow_status_id'));
                if ($employeeRolesArray) $obj->where("workflow_role_mfk like '%," . implode(",%' or workflow_role_mfk like '%,", $employeeRolesArray) . ",%'");
                $transList = $obj->loadMany();
                $objOriginal = null;
                $validTransList = [];
                foreach ($transList as $transItem) {
                        if ($transItem->sureIs("condition_before")) {
                                if (!$objOriginal) list($error, $objOriginal, $keyLookup) = $this->loadOriginalObject();
                                $wCondObj = $transItem->het("workflow_condition_id");
                                list($condition_success, $reason) = $objOriginal->runCondition($wCondObj, $this, "en");
                        } else $condition_success = true;

                        if ($condition_success) {
                                $validTransList[$transItem->id] = $transItem;
                        }
                }

                return $validTransList;
        }



        public function getOriginalData($lang = "ar")
        {
                list($error, $objOriginal, $keyLookup) = $this->loadOriginalObject();

                if (!$objOriginal)
                        return array("Original-Object looked up with ($keyLookup) not found  : $error", '');


                return $objOriginal->updateDataOfWorkflowRequest($this);
        }


        public function inspectMyAcceptedRoles($lang = "ar")
        {
                return $this->getMyAcceptedRoles($lang, true);
        }

        public function getMyAcceptedRoles($lang = "ar", $pbm = false)
        {
                $result = array();
                $transitionList = $this->getMyTransitions();

                $journal = [];

                if ($pbm) $journal[] = "My Transitions Found : " . count($transitionList);

                foreach ($transitionList as $transition) {
                        $accepted_roles_mfk = trim($transition->getVal("workflow_role_mfk"), ",");
                        if ($pbm) $journal[] = $transition->getDisplay($lang) . " : roles = $accepted_roles_mfk";
                        $authorizedRolesArray = explode(",", $accepted_roles_mfk);
                        $result = array_merge($result, $authorizedRolesArray);
                        if ($pbm) $journal[] = $transition->getDisplay($lang) . " : merged = " . implode("/", $result);
                }


                if ($pbm) return AfwFormatHelper::pbm_result('', $journal);
                else return $result;
        }


        public function runTransition($transitionId, $lang = 'ar')
        {
                $objTransition = WorkflowTransition::loadById($transitionId);

                $wEmployeeMe = WorkflowEmployee::getAuthenticatedEmployeeObject($this->getVal('orgunit_id'));

                $accepted_roles_mfk = trim($objTransition->getVal("workflow_role_mfk"), ",");

                $authorizedRolesArray = explode(",", $accepted_roles_mfk);

                if (!$wEmployeeMe) return array($this->tm('No authenticated workflow employee found', $lang), '');

                if (!$wEmployeeMe->hasOneOfWRoles($authorizedRolesArray)) {
                        $wrole_mfk = $wEmployeeMe->getVal("wrole_mfk");
                        return array($this->tm('This employee is not authorized to perform this transition', $lang) . '<!-- ID=' . $transitionId . " : accepted roles=$accepted_roles_mfk | my roles=$wrole_mfk -->", '');
                }

                list($error, $objOriginal, $keyLookup) = $this->loadOriginalObject();

                if (!$objOriginal)
                        return array("Original-Object looked up with ($keyLookup) not found  : $error", '');

                // $moduleObj = $objTransition->het("workflow_module_id");
                $wCondObj = $objTransition->het("workflow_condition_id");
                list($result, $reason) = $objOriginal->runCondition($wCondObj, $this, $lang);
                $wCondObjCode = $wCondObj->getVal("lookup_code");
                // return array("Condition for this transition is $wCondObjCode result = $result <br> reason = $reason", '');

                if (!$result)
                        return array($this->tm("Condition for this transition not satisfied", $lang) . " : " . $reason, '');




                $wActionObj = $objTransition->het("workflow_action_id");

                if (($wActionObj->getVal("action_type_enum") == 1) and ($wActionObj->sureIs("comments_mandatory"))) {
                        // Rjection needs rejection justifications comments
                        /*
                        $objComment = WorkflowRequestComment::findComment($this->id, $this->getVal('workflow_stage_id'), RequestCommentSubject::$REQUEST_COMMENT_SUBJECT_REJECT_REASON);
                        if ($objComment) {
                                $commentText = trim($objComment->getVal('comment'));
                                if (strlen($commentText) < 5) {
                                        return array('This transition needs rejection comments justifications of at least 5 characters', '');
                                }
                        } else {
                                return array('This transition needs before to enter rejection comments justifications', '');
                        }
                        */

                        if (!$this->getVal('workflow_rejection_reason_id')) {
                                $this->set("attempt", "Y");
                                $this->commit();
                                return array('', '', $this->tm('Please enter in the bottom of this form the rejection reason', $lang));
                        }
                }

                $final_stage_id = $objTransition->getVal('final_stage_id');
                $final_status_id = $objTransition->getVal('final_status_id');


                $workflow_stage_id = $this->getVal('workflow_stage_id');
                $workflow_status_id = $this->getVal('workflow_status_id');

                if (($final_stage_id != $workflow_stage_id) or ($final_status_id != $workflow_status_id)) {
                        $this->set('done', 'N');
                        $this->set('employee_id', 0);
                        $this->set("attempt", "N");
                        $this->set('workflow_stage_id', $final_stage_id);
                        $this->set('workflow_status_id', $final_status_id);
                        $this->commit();
                        $this->prepareInterviewBookingIfNeeded();

                        // after transition done reassign to best available employee depending on new stage and needed roles for this stage
                        $this->assignBestAvailableEmployee($lang, true, true);

                        $the_comment = "تم تنفيذ الاجراء : " . $objTransition->getDisplay($lang);
                        $comment_datetime = date('Y-m-d H:i:s');
                        $comment_time = date('H:i:s');
                        $status_comment = $comment_time . " : $the_comment [" . $objTransition->id . "]";
                        $request_comment_subject_id = $this->convenientCommentSubjectId();
                        $wrcObj = WorkflowRequestComment::loadByMainIndex($this->id, $request_comment_subject_id, $comment_datetime, $the_comment, $final_stage_id, true);
                } else {
                        $status_comment = $this->tm("Nothing done", $lang);
                }





                return array('', $status_comment);
        }



        public function isStarted()
        {
                return (($this->getVal('done') == "W") or ($this->getVal('done') == "Y"));
        }

        public function isFinished()
        {
                return ($this->getVal('done') == "Y");
        }

        public function assignRequest($employeeId, $lang = 'ar')
        {
                if ($this->getVal('done') == "W") {
                        return array('', $this->tm("Can't change the assign of a request when a work has been started on it. Please cancel this work before.", $lang));
                }
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

                $accepted_roles = $this->getMyAcceptedRoles();

                return WorkflowEmployee::getEmployeeList($this->getVal('orgunit_id'), $this->getVal('workflow_scope_id'), $except_employee_id, $accepted_roles);  // $this->getVal("employee_id")
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

                if ($this->isMine()) {



                        $employeesList = $this->getEmployees(true);
                        $transitionList = $this->getMyTransitions(true);
                        // if ($this->id == 16) die("rafik dyn getMyTransitions=" . var_export($transitionList, true));
                        // $orgunit_id = $this->getVal('orgunit_id');
                        // die("rafik dyn orgunit_id=$orgunit_id employeesList=" . var_export($employeesList, true));
                        foreach (self::$PUB_METHODS as $methodName0 => $publicDynamicMethodProps) {
                                if ($this->isStarted()) {
                                        if ($publicDynamicMethodProps['itemsMethod'] == 'getMyTransitions') {
                                                $pbms = AfwDynamicPublicMethodHelper::splitMethodWithItems($pbms, $publicDynamicMethodProps, $methodName0, $this, $log, $transitionList, false, true, $this->reachedStep(), "::getColor");
                                        }
                                }


                                if ($publicDynamicMethodProps['itemsMethod'] == 'getEmployees') {
                                        $pbms = AfwDynamicPublicMethodHelper::splitMethodWithItems($pbms, $publicDynamicMethodProps, $methodName0, $this, $log, $employeesList, false, true);
                                }
                        }

                        /**
                         * @var AFWObject $objOriginal
                         */

                        list($error, $objOriginal, $keyLookup) = $this->loadOriginalObject();

                        if ($objOriginal) {
                                $myStageObj = $this->het('workflow_stage_id');
                                // @todo ACRV should not be hard coded 
                                if (($this->isMine()) and ($this->getVal("done") == "W") and ($myStageObj->getVal("step_code") == "ACRV")) {
                                        $pbm_arr = $objOriginal->getPublishedMethodsFor($objme, "workflow-commitee");
                                        // die('rafik Published pbm_arr=' . var_export($pbm_arr, true));
                                        foreach ($pbm_arr as $pbm_code => $pbm_item) {
                                                $pbms[$pbm_code] = $pbm_item;
                                        }
                                }
                        }


                        if (count($transitionList) == 0) {
                                $color = 'yellow';
                                $title_ar = 'تحديث صلاحيات الموظف';
                                $methodName = 'notImplemented';
                                $pbms[AfwStringHelper::hzmEncode($methodName)] =
                                        array(
                                                'METHOD' => $methodName,
                                                'COLOR' => $color,
                                                'LABEL_AR' => $title_ar,
                                                'ADMIN-ONLY' => true,
                                                'BF-ID' => '',
                                                'TITLE-LENGTH' => 72,
                                                // 'STEP' => $this->stepOfAttribute('employee_id')
                                        );
                        }

                        $color = 'orange';
                        $title_ar = 'تحديث البيانات من الأصل';
                        $methodName = 'getOriginalData';
                        $pbms[AfwStringHelper::hzmEncode($methodName)] =
                                array(
                                        'METHOD' => $methodName,
                                        'COLOR' => $color,
                                        'LABEL_AR' => $title_ar,
                                        'ADMIN-ONLY' => true,
                                        'BF-ID' => '',
                                        'TITLE-LENGTH' => 72,
                                        // 'STEP' => $this->stepOfAttribute('employee_id')
                                );

                        $color = 'blue';
                        $title_ar = 'تحديث دعوة المقابلة';
                        $methodName = 'prepareInterviewBookingIfNeeded';
                        $pbms[AfwStringHelper::hzmEncode($methodName)] =
                                array(
                                        'METHOD' => $methodName,
                                        'COLOR' => $color,
                                        'LABEL_AR' => $title_ar,
                                        'ADMIN-ONLY' => true,
                                        'BF-ID' => '',
                                        'TITLE-LENGTH' => 72,
                                        // 'STEP' => $this->stepOfAttribute('employee_id')
                                );




                        $color = 'orange';
                        $title_ar = 'فحص الصلاحيات التي أحتاجها';
                        $methodName = 'inspectMyAcceptedRoles';
                        $pbms[AfwStringHelper::hzmEncode($methodName)] =
                                array(
                                        'METHOD' => $methodName,
                                        'COLOR' => $color,
                                        'LABEL_AR' => $title_ar,
                                        'ADMIN-ONLY' => true,
                                        'BF-ID' => '',
                                        'TITLE-LENGTH' => 72,
                                        // 'STEP' => $this->stepOfAttribute('employee_id')
                                );

                        $color = 'green';
                        $title_ar = 'تحويل الطلب إلى الموظف الأقل عبئا';
                        $methodName = 'assignBestAvailableEmployee';
                        $pbms[AfwStringHelper::hzmEncode($methodName)] =
                                array(
                                        'METHOD' => $methodName,
                                        'COLOR' => $color,
                                        'LABEL_AR' => $title_ar,
                                        'ROLES' => 'workflow/393',
                                        'PUBLIC' => true,
                                        'TITLE-LENGTH' => 72,
                                        // 'STEP' => $this->stepOfAttribute('employee_id')
                                );

                        $color = 'blue';
                        $title_ar = 'تحويل الطلب إلى اللجنة والموظف المناسبين';
                        $methodName = 'resetAssignBestAvailableEmployee';
                        $pbms[AfwStringHelper::hzmEncode($methodName)] =
                                array(
                                        'METHOD' => $methodName,
                                        'COLOR' => $color,
                                        'LABEL_AR' => $title_ar,
                                        'ROLES' => 'workflow/393',
                                        'PUBLIC' => true,
                                        'TITLE-LENGTH' => 72,
                                        // 'STEP' => $this->stepOfAttribute('employee_id')
                                );




                        if (($this->getVal("employee_id") > 0) and ($this->getVal("done") == "N")) {
                                $color = 'yellow';
                                $title_ar = 'بدأ العمل على الطلب';
                                $methodName = 'startWork';
                                $pbms[AfwStringHelper::hzmEncode($methodName)] =
                                        array(
                                                'METHOD' => $methodName,
                                                'COLOR' => $color,
                                                'MGROUP' => 'Start/Stop work',
                                                'LABEL_AR' => $title_ar,
                                                'ROLES' => 'workflow/403',
                                                'PUBLIC' => true,
                                                'TITLE-LENGTH' => 72,
                                                // 'STEP' => $this->stepOfAttribute('employee_id')
                                        );
                        } elseif (($this->getVal("employee_id") > 0) and ($this->getVal("done") == "W")) {
                                $color = 'gray';
                                $title_ar = 'إلغاء بدأ العمل على الطلب';
                                $methodName = 'cancelStartWork';
                                $pbms[AfwStringHelper::hzmEncode($methodName)] =
                                        array(
                                                'METHOD' => $methodName,
                                                'COLOR' => $color,
                                                'MGROUP' => 'Start/Stop work',
                                                'LABEL_AR' => $title_ar,
                                                'ROLES' => 'workflow/393', // فقط للمدير
                                                'PUBLIC' => true,
                                                'TITLE-LENGTH' => 72,
                                                // 'STEP' => $this->stepOfAttribute('employee_id')
                                        );
                        }
                }


                //die('rafik final pbms=' . var_export($pbms, true));

                return $pbms;
        }

        public function cancelStartWork($lang = 'ar')
        {
                $this->set("done", "N");
                $this->commit();
                // notify the employee that wis work on this request has been canceled                

                return ["", $this->tm("The work on this request has been canceled", $lang)];
        }


        public function startWork($lang = 'ar')
        {
                $this->set("done", "W"); // W means started Y means done N means not started
                $this->commit();


                return ["", $this->tm("The work on this request has been started", $lang)];
        }

        public function resetAssignBestAvailableEmployee($lang = 'ar', $pbm = true)
        {
                $this->assignBestAvailableEmployee($lang, $pbm, $reassignOrgunit = true);
        }

        public function assignBestAvailableEmployee($lang = 'ar', $pbm = true, $reassignOrgunit = false)
        {
                $workflow_scope_id = $this->getVal('workflow_scope_id');
                if ($reassignOrgunit) {
                        $myStageObj = $this->het('workflow_stage_id');
                        if ($myStageObj) $orgunit_id = $myStageObj->convenientOrgunitForScope($workflow_scope_id);
                        if ($orgunit_id and ($this->getVal('orgunit_id') != $orgunit_id)) {
                                $this->set('orgunit_id', $orgunit_id);
                                $this->set('employee_id', 0);
                        }
                }

                $this->commit();

                $strict = false;
                $except_emp_id = 0;
                $accepted_roles = $this->getMyAcceptedRoles();
                // die("For me w-request id=" . $this->id . " ac-roles are : " . var_export($accepted_roles, true));
                // find the best available employee
                if ($this->getVal('employee_id') > 0) {

                        $wEmployeeObj = WorkflowEmployee::findWorkflowEmployee($this->getVal('employee_id'));
                        if ($wEmployeeObj) {
                                $strict = true;
                                if (!$wEmployeeObj->hasOneOfWRoles($accepted_roles)) {
                                        $strict = false;
                                        $except_emp_id = $this->getVal('employee_id');
                                }
                        }
                }
                $orgunit_id = $this->getVal('orgunit_id');


                list($best_employee_id, $wkfEmpl, $allList, $log) = WorkflowEmployee::getBestAvailableEmployee($orgunit_id, $workflow_scope_id, $except_emp_id, $strict, $accepted_roles);
                // $wkfRes = array("best" => $best_employee_id, "res" => $wkfEmpl, 'all' => $allList);
                // die("<pre>CrmEmployee::assignBestAvailableEmployee() returned object : ". var_export($wkfRes, true)."</pre>");

                /**
                 * @var WorkflowEmployee $wkfEmplObj
                 */
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
                                return array('', $this->tm('request has beeen assigned to ') . $emplObj->getDisplay($lang), '', $log);
                        elseif ($strict) {
                                $emplObj = $this->het('employee_id');
                                return array('', $this->tm('This request already assigned to ') . $emplObj->getDisplay($lang), '', $log);
                        } else
                                return array($this->tm('No suitable available employee for the request') . ' : ' . $this->id, '', '', $log);
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
                                return ['No session for this request', null];;

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

                $cand_info = $this->calcCandidateInfo($what);

                $status = $this->decode("workflow_status_id", '', false, $lang);
                if ($this->getVal("employee_id") > 0) {
                        $empl_info = $this->decode("employee_id", '', false, $lang) . "-" . $this->decode("done", '', false, $lang);
                        $cssinfo = "CSS" . $this->decode("done");
                } else {
                        $empl_info = "";
                        $cssinfo = "CSSN";
                }


                $status_id = $this->getVal("workflow_status_id");

                $myId = $this->id;

                return "<div id='wreq-$myId-category' class='wcategory'>
                                <span class='idn'>$idn</span>
                                <span class='fname'>$name</span>
                                <span class='fstatus st$status_id'>$status</span>
                                <span class='wrcandinfo'>$cand_info</span>
                                <span class='wremplinfo $cssinfo'>$empl_info</span>
                        </div>";
        }

        public function calcFormComments($what = 'value')
        {
                $workflow_stage_id = $this->getVal('workflow_stage_id');
                $myId = $this->id;
                $lang = AfwLanguageHelper::getGlobalLanguage();
                $obj = new WorkflowRequestComment();
                $obj->set('workflow_request_id', $myId);
                $obj->set('workflow_stage_id', $workflow_stage_id);
                $inputStage = '';

                /*
                 * list(
                 *         $inputStage,
                 * ) = AfwInputHelper::hidden_input('comment_workflow_stage_id', null, $this->getVal('workflow_stage_id'), $obj);
                 */
                $request_comment_subject_id = 0;
                $currstep = $_REQUEST['currstep'];
                if ($currstep <= 2)
                        $request_comment_subject_id = 1;
                elseif ($currstep <= 4)
                        $request_comment_subject_id = 2;
                elseif ($currstep <= 6)
                        $request_comment_subject_id = 3;

                $desc_erase = array('MANDATORY' => false);
                $inputSubject = AfwInputHelper::simpleEditInputForAttribute('request_comment_subject_id', $request_comment_subject_id, null, $obj, ':', $desc_erase);
                $inputComment = AfwInputHelper::simpleEditInputForAttribute('comment', '', null, $obj, ':', $desc_erase);
                $add_title = AfwLanguageHelper::translateKeyword('ADD', $lang);
                $add_comment_label = $this->tm('Add comment', $lang);

                $objme = AfwSession::getUserConnected();
                $you_dont_have_rights = $objme->translateMessage('CANT_DO_THIS', $lang);

                if ((!$objme) or (!$objme->isAdmin()))
                        $response_data_format = "data = '';\n";
                else
                        $response_data_format = '';
                return $this->showAttribute('workflowRequestCommentList')
                        . "<div id='wreq-$myId-comments' class='wcomments'>
                                <label>$add_comment_label</label>
                                $inputStage
                                <div class='subject'>$inputSubject</div>
                                <div class='comment'>$inputComment</div>
                                <div class='ppsave'><input type='button' name='addwrcomment' id='addwrcomment' request='$myId' class='fa greenbtn wizardbtn' value='&nbsp;$add_title&nbsp;' style='margin-right: 5px;'></div>
                        </div>
                        <script>
                                function addTr(id,dd,stage,subject,comment)
                                {
                                        // Construct the new row's HTML
                                        rowHtml = \"<tr id='tr-object-\"+id+\"' class='ky addeditem workf csr_active hzm_row_Y'>\\n\";
                                        rowHtml = rowHtml + \"<td id='comment_date-\"+id+\"' class='col-importance-high hzm_col hzm_col_afw hzm_col_afw_comme hzm_col_afw_comment_date'>\\n\";
                                        rowHtml = rowHtml + \"<span class='comment_date-span'>\"+dd+\"\\n\";
                                        rowHtml = rowHtml + \"</span></td>\\n\";
                                        rowHtml = rowHtml + \"<td id='request_comment_subject_id-\"+id+\"' class='col-importance-high hzm_col hzm_col_afw hzm_col_afw_reque hzm_col_afw_request_comment_subject_id'>\\n\";
                                        rowHtml = rowHtml + \"<span class='request_comment_subject_id-span'>\"+subject+\"\\n\";
                                        rowHtml = rowHtml + \"</span></td>\\n\";
                                        rowHtml = rowHtml + \"<td id='workflow_stage_id-\"+id+\"' class='col-importance-small hzm_col hzm_col_afw hzm_col_afw_workf hzm_col_afw_workflow_stage_id'>\\n\";
                                        rowHtml = rowHtml + \"<span class='workflow_stage_id-span'>\"+stage+\"\\n\";
                                        rowHtml = rowHtml + \"</span></td>\\n\";
                                        rowHtml = rowHtml + \"<td id='comment-\"+id+\"' class='col-importance-small hzm_col hzm_col_afw hzm_col_afw_comme hzm_col_afw_comment'>\\n\";
                                        rowHtml = rowHtml + \"<span class='comment-span'>\"+comment+\"\\n\";
                                        rowHtml = rowHtml + \"</span></td>\\n\";
                                        rowHtml = rowHtml + \"<td id='عرض-\"+id+\"' class='col-importance-small hzm_col hzm_col_afw hzm_col_afw_3Ru hzm_col_afw_3Ru'>\\n\";
                                        rowHtml = rowHtml + \"<span class='عرض-span'>\\n\";
                                        rowHtml = rowHtml + \"<a href='main.php?Main_Page=afw_mode_display.php&amp;cl=WorkflowRequestComment&amp;currmod=workflow&amp;id=\"+id+\"&amp;currstep=1' data-original-title='' title=''>\\n\";
                                        rowHtml = rowHtml + \"<img src='../lib/images/view_ok.png' width='24' heigth='24' data-toggle='tooltip' data-placement='top' title='' data-original-title=''></a>\\n\";
                                        rowHtml = rowHtml + \"</span></td>\\n\";
                                        rowHtml = rowHtml + \"<td id='مسح-\"+id+\"' class='col-importance-small hzm_col hzm_col_afw hzm_col_afw_MS7 hzm_col_afw_MS7'>\\n\";
                                        rowHtml = rowHtml + \"<a href='#' here='afw_shwr' id='\"+id+\"' cl='WorkflowRequestComment' md='workflow' lbl='' lvl='2' class='trash showmany' data-original-title='' title=''>\\n\";
                                        rowHtml = rowHtml + \"<img src='../lib/images/trash.png' style='height: 22px !important;'></a></td>\\n\";
                                        rowHtml = rowHtml + \"</tr>\";

                                        let newRowHtml = rowHtml;
                                        
                                        // Append the new row to the tbody
                                        \$(\"#workflowRequestCommentListTableBody\").append(newRowHtml);
                                }       

                                function addWorkflowRequestComment()
                                {
                                the_idreq = $myId;
                                the_stage = $workflow_stage_id;
                                the_lang = '$lang';
                                the_subject = \$('#request_comment_subject_id').val();
                                the_comment = \$('#comment').val();
                                \$.ajax({
                                        type:'POST',
                                        url:'../workflow/api/wkfaddcomment.php',                                           
                                        data:{idreq:the_idreq, stage:the_stage, subject:the_subject, comment:the_comment, lang:the_lang},
                                        dataType: 'json',
                                        success: function(data)
                                        {
                                                // console.log('idreq='+idreq+' stage='+stage+' subject='+subject+' comment='+comment+' wkfaddcomment response = ', data);
                                                if(data.status=='success')
                                                {
                                                        addTr(data.aff.id,data.aff.dd,data.aff.stage,data.aff.subject,data.aff.comment);                    
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
                                        });
                                });

                        </script>
                        ";
        }

        public function shouldBeCalculatedField($attribute)
        {
                if ($attribute == "mobile") return true;
                if ($attribute == "email") return true;
                if ($attribute == "country_id") return true;
                if ($attribute == "gender_enum") return true;
                if ($attribute == "birth_gdate") return true;
                if ($attribute == "passeport_num") return true;
                if ($attribute == "category") return true;
                if ($attribute == "div_step_3") return true;
                if ($attribute == "div_step_4") return true;
                if ($attribute == "div_step_5") return true;
                if ($attribute == "div_step_6") return true;
                if ($attribute == "div_step_7") return true;
                if ($attribute == "div_step_8") return true;
                if ($attribute == "formComments") return true;
                return false;
        }


        public static function stepOfStage($stageId)
        {
                // not good like this to be hardcoded, please fix later @todo-rafik
                return $stageId + 4;
        }

        public function reachedStep()
        {

                $stageId = $this->getVal('workflow_stage_id');
                return self::stepOfStage($stageId);
        }

        public function convenientCommentSubjectId()
        {
                $request_comment_subject_id = 1;
                $currstep = $this->reachedStep();
                if ($currstep <= 2)
                        $request_comment_subject_id = 1;
                elseif ($currstep <= 4)
                        $request_comment_subject_id = 2;
                elseif ($currstep <= 6)
                        $request_comment_subject_id = 3;

                return $request_comment_subject_id;
        }

        public function weReachedStep($step)
        {
                // step1 =>  'البيانات الشخصية';
                // step2 =>  'طلب التقديم';
                // step3 =>  'المؤهلات';
                // step4 =>  'الاختبارات';
                // step5 =>  'مراجعة الوثائق';
                // step6 =>  'مراجعة اللجنة';
                // step7 =>  'المقابلة الشخصية';
                // step8 =>  'المفاضلة والقبول';

                return ($this->reachedStep() >= $step);
        }

        public function calcDiv_step($step, $what = 'value')
        {
                $lang = AfwLanguageHelper::getGlobalLanguage();

                list($error, $objOriginal, $keyLookup) = $this->loadOriginalObject();

                if (!$objOriginal)
                        return "not found Original-Object looked up with ($keyLookup) : $error";

                return $objOriginal->calcDivForWorkflowStep($step, $what, $this);
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
                        and done = 'N'");
                $obj->update(false);
                unset($obj);

                $obj = new WorkflowRequest();
                $obj->where("employee_id=0 and orgunit_id > 0 and done = 'N'");
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


        public function beforeDelete($id, $id_replace)
        {
                if ($this->getVal("done") != "N") {
                        $this->deleteNotAllowedReason = "Can't be deleted because some work has started on it.";
                        return false;
                }
                $server_db_prefix = AfwSession::config("db_prefix", "nauss_");

                if (!$id) {
                        $id = $this->getId();
                        $simul = true;
                } else {
                        $simul = false;
                }

                if ($id) {
                        if ($id_replace == 0) {
                                // FK part of me - not deletable 

                                // FK part of me - deletable 
                                $obj = new WorkflowRequestData();
                                if (!$simul) $obj->deleteWhere("workflow_request_id = '$id'");

                                $obj = new WorkflowRequestComment();
                                if (!$simul) $obj->deleteWhere("workflow_request_id = '$id'");



                                // FK not part of me - replaceable 



                                // MFK

                        } else {
                                // FK on me 


                                // workflow.workflow_request_data-الطلب	workflow_request_id  أنا تفاصيل لها (required field)
                                if (!$simul) {
                                        // require_once "../workflow/workflow_request_data.php";
                                        WorkflowRequestData::updateWhere(array('workflow_request_id' => $id_replace), "workflow_request_id='$id'");
                                        // $this->execQuery("update ${server_db_prefix}workflow.workflow_request_data set workflow_request_id='$id_replace' where workflow_request_id='$id' ");

                                }




                                // workflow.workflow_request_comment-الطلب	workflow_request_id  أنا تفاصيل لها (required field)
                                if (!$simul) {
                                        // require_once "../workflow/workflow_request_comment.php";
                                        WorkflowRequestComment::updateWhere(array('workflow_request_id' => $id_replace), "workflow_request_id='$id'");
                                        // $this->execQuery("update ${server_db_prefix}workflow.workflow_request_comment set workflow_request_id='$id_replace' where workflow_request_id='$id' ");

                                }




                                // MFK


                        }
                        return true;
                }
        }

        public function attributeIsApplicable($attribute)
        {
                for ($step = 1; $step <= 8; $step++) {
                        if ($attribute == "div_step_$step") {
                                return $this->weReachedStep($step);
                        }
                }

                if ($attribute == "workflow_rejection_reason_id") return ($this->isStarted() and $this->sureIs("attempt"));


                if ($attribute == "interview_score") return $this->isStarted();

                return true;
        }


        public function current($field_name, $col_struct)
        {
                $col_struct = strtolower($col_struct);

                if ($col_struct == "step") {
                        return $this->reachedStep();
                }


                throw new AfwRuntimeException("current(field_name=$field_name, col_struct=$col_struct) not implemented");
        }


        public function isMine()
        {
                $objme = AfwSession::getUserConnected();

                if ($objme and $objme->isAdmin()) {
                        return true;
                } else {
                        $employee_id = $objme ? $objme->getEmployeeId() : 0;
                        return ($employee_id and ($employee_id == $this->getVal("employee_id")));
                }
        }


        protected function getOtherLinksArray($mode, $genereLog = false, $step = "all")
        {
                global $lang;
                $otherLinksArray = $this->getOtherLinksArrayStandard($mode, false, $step);
                $my_id = $this->getId();
                $displ = $this->getDisplay($lang);

                if ($mode == "mode_category") {
                        if (!$this->isMine()) {
                                unset($link);
                                $link = array();
                                $title = "ليس لك حاليا صلاحية العمل على هذا الطلب، يرجى الضغط على زر انهاء للعودة إلى صندوق الوارد";
                                $link["URL"] = "@help";
                                $link["CODE"] = "stop.and.debugg";
                                $link["TITLE"] = $title;
                                $link["PUBLIC"] = true;
                                $otherLinksArray[] = $link;
                        } elseif (!$this->isStarted()) {
                                unset($link);
                                $link = array();
                                $title = "لم يبدأ العمل على هذا الطلب رجاء الضغط على زر 'بدأ العمل على الطلب' في أسفل صفحة لتتمكن من تنفيذ الاجراءات عليه";
                                $link["URL"] = "@help";
                                $link["CODE"] = "stop.and.debugg";
                                $link["TITLE"] = $title;
                                $link["PUBLIC"] = true;
                                $otherLinksArray[] = $link;
                        }
                }



                return $otherLinksArray;
        }

        public function select_visibilite_horizontale($dropdown = false)
        {
                $objme = AfwSession::getUserConnected();

                if ($objme and $objme->isAdmin()) {
                        // no VH for system admin
                }
                /* Amjad whatsapp 18/01/2026 7pm ~ audio say do not limit for users for the moment
                else {
                        $employee_id = $objme ? $objme->getEmployeeId() : 0;

                        if ($employee_id) {
                                $wEmplObj = WorkflowEmployee::findWorkflowEmployee($employee_id);
                                if ($wEmplObj) {
                                        $wscope_mfk = $wEmplObj->getVal("wscope_mfk");
                                        $this->where("employee_id=$employee_id and '$wscope_mfk' like concat('%,',workflow_scope_id,',%')");
                                }
                        }
                }*/

                $selects = array();
                $this->select_visibilite_horizontale_default($dropdown, $selects);
        }


        public function prepareInterviewBookingIfNeeded($lang = "ar", $returnInterviewBookingObject = false)
        {
                $ibObj = null;
                $statusObj = $this->het("workflow_status_id");
                if ($statusObj->sureIs("interview_invite_ind")) {
                        $workflow_stage_id = $this->getVal('workflow_stage_id');
                        $itpObj = InterviewTypePattern::loadByMainIndex($workflow_stage_id);
                        $workflow_applicant_id = $this->getVal("workflow_applicant_id");
                        $workflow_session_id = $this->getVal("workflow_session_id");
                        // if the pattern exists it means we should create a booking invite
                        if ($itpObj) {
                                $ibObj = InterviewBooking::loadByMainIndex($workflow_applicant_id, $workflow_session_id, $itpObj->id, true);
                                if ($ibObj) {
                                        $workflow_scope_id = $this->getVal("workflow_scope_id");
                                        $booking_status_id = 6;
                                        $reschedule_count = $ibObj->getVal("max_reschedule");
                                        $can_reschedule_ind = ($reschedule_count > 0) ? "Y" : "N";
                                        $can_cancel_ind = $ibObj->getVal("can_cancel_ind");
                                        $ibObj->set("workflow_scope_id", $workflow_scope_id);
                                        $ibObj->set("workflow_request_id", $this->id);
                                        $ibObj->set("booking_status_id", $booking_status_id);
                                        $ibObj->set("reschedule_count", $reschedule_count);
                                        $ibObj->set("can_reschedule_ind", $can_reschedule_ind);
                                        $ibObj->set("can_cancel_ind", $can_cancel_ind);
                                        $ibObj->commit();
                                        $return = ["", $this->tm("Interview booking invite has been created", $lang), ""];
                                } else $return = [$this->tm("Failed to create interview booking invitation", $lang), ""];
                        } else $return = [$this->tm("Interview booking pattern not found", $lang), ""];
                } else $return = ["", $this->tm("Interview booking invite not needed", $lang), ""];


                if ($returnInterviewBookingObject) return $ibObj;
                else return $return;
        }

        public function getInterviewBooking()
        {
                return $this->prepareInterviewBookingIfNeeded($lang = "ar", $returnInterviewBookingObject = true);
        }





        /**
         * @param Auser $auser
         */

        /*
        public function canAssignRequest($auser, $mode)
        {
                return $auser->hasRole($module_code, $role_id);
        }
        */
}
