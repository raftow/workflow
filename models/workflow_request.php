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
                        'confirmation_question' => '',
                        'itemsMethod' => 'getEmployees',
                ),


                'runTransition' => array(
                        'title' => 'تنفيذ [item]',
                        'color' => 'yellow',
                        'confirmation_needed' => false,
                        'confirmation_warning' => '',
                        'confirmation_question' => '',
                        'itemsMethod' => 'getMyTransitions',
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

                return false;
                // the above return should be keeped if not treated
        }


        public function getMyTransitions()
        {
                $wEmployeeMe = WorkflowEmployee::getAuthenticatedEmployeeObject();
                if (!$wEmployeeMe) return array();
                $employeeRolesArray = explode(",", trim($this->getVal("wEmployeeMe"), ","));

                $obj = new WorkflowTransition();
                $obj->select('workflow_model_id', $this->getVal('workflow_model_id'));
                $obj->select('initial_stage_id', $this->getVal('workflow_stage_id'));
                $obj->select('initial_status_id', $this->getVal('workflow_status_id'));
                $obj->where("workflow_role_mfk like '%," . implode(",%' or workflow_role_mfk like '%,", $employeeRolesArray) . ",%'");
                return $obj->loadMany();
        }

        public function getMyAcceptedRoles()
        {
                $result = array();
                $transitionList = $this->getMyTransitions();

                foreach ($transitionList as $transition) {
                        $accepted_roles_mfk = trim($transition->getVal("workflow_role_mfk"), ",");
                        $authorizedRolesArray = explode(",", $accepted_roles_mfk);
                        $result = array_merge($result, $authorizedRolesArray);
                }

                return $result;
        }


        public function runTransition($transitionId, $lang = 'ar')
        {
                $objTransition = WorkflowTransition::loadById($transitionId);

                $wEmployeeMe = WorkflowEmployee::getAuthenticatedEmployeeObject();

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

                $workflow_stage_id = $this->getVal('workflow_stage_id');


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
                                return array($this->tm('This transition needs before to select rejection reason', $lang), '');
                        }
                }

                $final_stage_id = $objTransition->getVal('final_stage_id');
                $final_status_id = $objTransition->getVal('final_status_id');

                $this->set('workflow_stage_id', $final_stage_id);
                $this->set('workflow_status_id', $final_status_id);
                $this->commit();

                // after transition done reassign to best available employee depending on new stage and needed roles for this stage
                $this->assignBestAvailableEmployee($lang);


                $status_comment = date('H:i:s') . ': تم تنفيذ الانتقال [' . $objTransition->id . "] " . $objTransition->getDisplay($lang);

                return array('', $status_comment);
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
                        array(
                                'METHOD' => $methodName,
                                'COLOR' => $color,
                                'LABEL_AR' => $title_ar,
                                'ADMIN-ONLY' => true,
                                'BF-ID' => '',
                                'STEP' => $this->stepOfAttribute('employee_id')
                        );

                $employeesList = $this->getEmployees(true);
                $transitionList = $this->getMyTransitions(true);
                // $orgunit_id = $this->getVal('orgunit_id');
                // die("rafik dyn orgunit_id=$orgunit_id employeesList=" . var_export($employeesList, true));
                foreach (self::$PUB_METHODS as $methodName0 => $publicDynamicMethodProps) {
                        if ($publicDynamicMethodProps['itemsMethod'] == 'getEmployees') {
                                $pbms = AfwDynamicPublicMethodHelper::splitMethodWithItems($pbms, $publicDynamicMethodProps, $methodName0, $this, $log, $employeesList);
                        }

                        if ($publicDynamicMethodProps['itemsMethod'] == 'getMyTransitions') {
                                $pbms = AfwDynamicPublicMethodHelper::splitMethodWithItems($pbms, $publicDynamicMethodProps, $methodName0, $this, $log, $transitionList, false, true);
                        }
                }





                // die('rafik dyn pbms=' . var_export($pbms, true));

                return $pbms;
        }

        public function assignBestAvailableEmployee($lang = 'ar', $pbm = true)
        {
                $strict = false;
                $except_emp_id = 0;
                $accepted_roles = $this->getMyAcceptedRoles();
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
                $workflow_scope_id = $this->getVal('workflow_scope_id');

                list($best_employee_id, $wkfEmpl, $allList, $log) = WorkflowEmployee::getBestAvailableEmployee($orgunit_id, $workflow_scope_id, $except_emp_id, $strict, $accepted_roles);
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

                $info = $this->calcCandidateInfo($what);

                $status = $this->decode("workflow_status_id", '', false, $lang);
                $status_id = $this->getVal("workflow_status_id");

                $myId = $this->id;

                return "<div id='wreq-$myId-category' class='wcategory'>
                                <span class='idn'>$idn</span>
                                <span class='fname'>$name</span>
                                <span class='fstatus st$status_id'>$status</span>
                                <span class='wrinfo'>$info</span>
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

                $inputSubject = AfwInputHelper::simpleEditInputForAttribute('request_comment_subject_id', $request_comment_subject_id, null, $obj);
                $desc_erase = array('MANDATORY' => false);
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

        public function weReachedStep($step)
        {
                // step1 =>  'البيانات الشخصية';
                // step2 =>  'طلب التقديم';
                // step3 =>  'المؤهلات';
                // step4 =>  'الاختبارات';
                // step5 =>  'مراجعة الوثائق';
                if ($step <= 5) {
                        return true;
                }

                $stageObj = $this->het('workflow_stage_id');

                // step6 =>  'مراجعة اللجنة';
                if ($step == 6) {
                        return ($stageObj->id >= 2);  // not good like this to be hardcoded, please fix later @todo-rafik
                }
                // step7 =>  'المقابلة الشخصية';
                if ($step == 7) {
                        return ($stageObj->id >= 3);  // not good like this to be hardcoded, please fix later @todo-rafik
                }
                // step8 =>  'المفاضلة والقبول';
                if ($step == 8) {
                        return ($stageObj->id >= 4);  // not good like this to be hardcoded, please fix later @todo-rafik
                }
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


        public function beforeDelete($id, $id_replace)
        {
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
                                // workflow.workflow_request_data-الطلب	workflow_request_id  أنا تفاصيل لها (required field)
                                // require_once "../workflow/workflow_request_data.php";
                                $obj = new WorkflowRequestData();
                                $obj->where("workflow_request_id = '$id' and active='Y' ");
                                $nbRecords = $obj->count();
                                // check if there's no record that block the delete operation
                                if ($nbRecords > 0) {
                                        $this->deleteNotAllowedReason = "Used in some Workflow request datas(s) as Workflow request";
                                        return false;
                                }
                                // if there's no record that block the delete operation perform the delete of the other records linked with me and deletable
                                if (!$simul) $obj->deleteWhere("workflow_request_id = '$id' and active='N'");

                                // workflow.workflow_request_comment-الطلب	workflow_request_id  أنا تفاصيل لها (required field)
                                // require_once "../workflow/workflow_request_comment.php";
                                $obj = new WorkflowRequestComment();
                                $obj->where("workflow_request_id = '$id' and active='Y' ");
                                $nbRecords = $obj->count();
                                // check if there's no record that block the delete operation
                                if ($nbRecords > 0) {
                                        $this->deleteNotAllowedReason = "Used in some Workflow session(s) as workflow_request_id";
                                        return false;
                                }
                                // if there's no record that block the delete operation perform the delete of the other records linked with me and deletable
                                if (!$simul) $obj->deleteWhere("workflow_request_id = '$id' and active='N'");



                                // FK part of me - deletable 


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


                return true;
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
