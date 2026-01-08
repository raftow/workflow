<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table workflow_orgunit : workflow_orgunit - جهات المتابعة و إعداداتها
// ------------------------------------------------------------------------------------
// alter table ".$server_db_prefix."workflow.workflow_employee add   admin char(1) DEFAULT NULL  after service_mfk;
// update ".$server_db_prefix."workflow.workflow_employee set admin = 'N';

$file_dir_name = dirname(__FILE__);

// old include of afw.php

class WorkflowEmployee extends WorkflowObject
{
        public static $orgListOfEmployee = [];
        public static $DATABASE = '';
        public static $MODULE = 'workflow';
        public static $TABLE = 'workflow_employee';
        public static $DB_STRUCTURE = null;

        public function __construct()
        {
                parent::__construct('workflow_employee', 'id', 'workflow');
                WorkflowWorkflowEmployeeAfwStructure::initInstance($this);
        }

        /*
         * public static function resetAll()
         * {
         *    $obj = new WorkflowEmployee();
         *    $obj->setForce("active", "N");
         *    $obj->setForce("admin", "N");
         *    return $obj->update(false);
         * }
         */

        public static function loadById($id)
        {
                $obj = new WorkflowEmployee();
                // $obj->select_visibilite_horizontale();
                if ($obj->load($id)) {
                        return $obj;
                } else
                        return null;
        }

        public static function getAuthenticatedEmployeeObject()
        {
                $objme = AfwSession::getUserConnected();
                if ($objme) {
                        $employee_id = $objme->getEmployeeId();
                        if ($employee_id) {
                                return WorkflowEmployee::findWorkflowEmployee($employee_id);
                        }
                }
                return null;
        }

        public function hasOneOfWRoles($rolesArray)
        {
                $myRolesArray = explode(",", trim($this->getVal("wrole_mfk"), ","));
                foreach ($myRolesArray as $myrole) {
                        if (in_array($myrole, $rolesArray))
                                return true;
                }

                return false;
        }

        public function select_visibilite_horizontale($dropdown = false)
        {
                $objme = AfwSession::getUserConnected();

                if ($objme and $objme->isAdmin()) {
                        // no VH for system admin
                } else {
                        /*
                         * $empl_id = $objme ? $objme->getEmployeeId() : 0;
                         *
                         * if($empl_id) $iam_general_supervisor = WorkflowObject::userIsGeneralCommitee();
                         * if($empl_id) $iam_supervisor = WorkflowObject::userIsCommitee();
                         *
                         * if(!$iam_general_supervisor) $iam_general_supervisor = 0;
                         * if(!$iam_supervisor) $iam_supervisor = 0;
                         *
                         * // if the user is an employee
                         * // he is allowed to see workflow employee if :
                         * // 1. he is a general commitee
                         * // or
                         * // 2. he is a commitee
                         *
                         * $employee_allowed_to_see_workflow_employee_cond =
                         *     "($iam_general_supervisor>0 or $iam_supervisor>0)";
                         * $this->where("($empl_id>0 and $employee_allowed_to_see_workflow_employee_cond)");
                         */
                        $this->where('1=0');
                }

                $selects = array();
                $this->select_visibilite_horizontale_default($dropdown, $selects);
        }

        /**
         * @return WorkflowEmployee
         */
        public static function loadByMainIndex($orgunit_id, $employee_id, $create_obj_if_not_found = false)
        {
                $obj = new WorkflowEmployee();
                if (!$orgunit_id)
                        throw new AfwRuntimeException('loadByMainIndex : orgunit_id is mandatory field');
                if (!$employee_id)
                        throw new AfwRuntimeException('loadByMainIndex : employee_id is mandatory field');

                $obj->select('orgunit_id', $orgunit_id);
                $obj->select('employee_id', $employee_id);

                if ($obj->load()) {
                        if ($create_obj_if_not_found)
                                $obj->activate();
                        return $obj;
                } elseif ($create_obj_if_not_found) {
                        $obj->set('orgunit_id', $orgunit_id);
                        $obj->set('employee_id', $employee_id);

                        $obj->insert();
                        $obj->is_new = true;
                        return $obj;
                } else
                        return null;
        }

        /**
         * @return WorkflowEmployee
         */
        public static function findWorkflowEmployee($employee_id, $orgunit_id = 0)
        {
                if (!$orgunit_id)
                        $orgunit_id = WorkflowEmployee::orgOfEmployee($employee_id, false, true);
                return WorkflowEmployee::checkExistance($orgunit_id, $employee_id);
        }

        /**
         * @return WorkflowEmployee
         */
        public static function checkExistance($orgunit_id, $employee_id)
        {
                if (!$orgunit_id)
                        return null;
                if (!$employee_id)
                        return null;

                return self::loadByMainIndex($orgunit_id, $employee_id, $create_obj_if_not_found = false);
        }

        public function getDisplay($lang = 'ar')
        {
                $data = array();
                $link = array();

                list($data[0], $link[0]) = $this->displayAttribute('employee_id', false, $lang);
                list($data[1], $link[1]) = $this->displayAttribute('orgunit_id', false, $lang);

                return implode(' - ', $data);
        }

        public function getShortDisplay($lang = 'ar')
        {
                return $this->showAttribute('employee_id');
        }

        public function stepsAreOrdered()
        {
                return true;
        }

        protected function getOtherLinksArray($mode, $genereLog = false, $step = 'all')
        {
                $lang = AfwLanguageHelper::getGlobalLanguage();
                $otherLinksArray = $this->getOtherLinksArrayStandard($mode, false, $step);
                $my_id = $this->getId();
                $displ = $this->getDisplay($lang);

                return $otherLinksArray;
        }

        protected function getPublicMethods()
        {
                $pbms = array();

                $color = 'green';
                $title_ar = 'اشعرني بايميل';
                $methodName = 'notifyMe';
                $pbms[AfwStringHelper::hzmEncode($methodName)] = array(
                        'METHOD' => $methodName,
                        'COLOR' => $color,
                        'LABEL_AR' => $title_ar,
                        'PUBLIC' => true,
                        'BF-ID' => '',
                        'STEP' => 1,
                );

                $color = 'red';
                $title_ar = 'تصفير كلمة المرور';
                $methodName = 'resetPassword';
                $pbms[AfwStringHelper::hzmEncode($methodName)] = array(
                        'METHOD' => $methodName,
                        'COLOR' => $color,
                        'LABEL_AR' => $title_ar,
                        'PUBLIC' => true,
                        // 'ADMIN-ONLY' => true,
                        'BF-ID' => '',
                        'STEP' => 3,
                );

                $color = 'yellow';
                $title_ar = 'تصفير الصلاحيات';
                $methodName = 'resetPrevileges';
                $pbms[AfwStringHelper::hzmEncode($methodName)] = array(
                        'METHOD' => $methodName,
                        'COLOR' => $color,
                        'LABEL_AR' => $title_ar,
                        // 'PUBLIC' => true,
                        'ADMIN-ONLY' => true,
                        'BF-ID' => '',
                        'STEP' => 3,
                );

                $color = 'green';
                $title_ar = 'استخراج وتفقد ملف صلاحيات المستخدم';
                $methodName = 'getPrevilegesPhpCodeForUser';
                $pbms[AfwStringHelper::hzmEncode($methodName)] = array(
                        'METHOD' => $methodName,
                        'COLOR' => $color,
                        'LABEL_AR' => $title_ar,
                        // 'PUBLIC' => true,
                        'ADMIN-ONLY' => true,
                        'BF-ID' => '',
                        'STEP' => 3,
                );

                return $pbms;
        }

        public function afterInsert($id, $fields_updated, $disableAfterCommitDBEvent = false) {}

        public function afterUpdate($id, $fields_updated, $disableAfterCommitDBEvent = false) {}

        private function removeMeAllAssigned()
        {
                $obj = new WorkflowRequest();

                $me_id = $this->getVal('employee_id');
                $me_org_id = $this->getVal('orgunit_id');

                /*
                 * $obj->where("superv isor_id = $me_id");
                 * $obj->where("status_id not in (6,7,8,9)");
                 * $obj->setForce("super visor_id",0);
                 * $obj->update(false);
                 */

                $obj->where("(employee_id = $me_id and orgunit_id = $me_org_id)");
                $obj->where('status_id in (2,4,)');
                $obj->setForce('employee_id', 0);
                $obj->setForce('orgunit_id', 0);
                $status_comment = 'removeMeAllAssigned me_id=' . $me_id;
                $obj->setForce('status_comment', $status_comment);
                $obj->update(false);
        }

        public function beforeMaj($id, $fields_updated)
        {
                $lang = AfwLanguageHelper::getGlobalLanguage();
                $main_orgunit_id = AfwSession::config('main_orgunit_id', 1);
                $email = $this->getVal('email');
                $objEmployee = null;
                if ($fields_updated['email']) {
                        $objEmployee = Employee::loadByEmail($main_orgunit_id, $email);
                        if ($objEmployee and $objEmployee->getVal('firstname')) {
                                $this->set('gender_id', $objEmployee->getVal('gender_id'));
                                $this->set('country_id', $objEmployee->getVal('country_id'));
                                $this->set('firstname', $objEmployee->getVal('firstname'));
                                $this->set('f_firstname', $objEmployee->getVal('f_firstname'));
                                $this->set('g_f_firstname', $objEmployee->getVal('g_f_firstname'));
                                $this->set('lastname', $objEmployee->getVal('lastname'));
                                $this->set('firstname_en', $objEmployee->getVal('firstname_en'));
                                $this->set('f_firstname_en', $objEmployee->getVal('f_firstname_en'));
                                $this->set('g_f_firstname_en', $objEmployee->getVal('g_f_firstname_en'));
                                $this->set('lastname_en', $objEmployee->getVal('lastname_en'));
                        }
                }

                if ($fields_updated['wrole_mfk']) {
                        $this->resetPrevileges('ar', $objEmployee, false);
                }

                return true;
        }

        /**
         * @param Employee $objEmployee
         */
        public function resetPrevileges($lang = 'ar', $objEmployee = null, $commit = true)
        {
                $err_arr = [];
                $inf_arr = [];
                $war_arr = [];
                $tech_arr = [];

                $email = $this->getVal('email');
                if ($email) {
                        if (!$objEmployee)
                                $objEmployee = Employee::loadByEmail(1, $email, true);
                        if ($objEmployee->is_new or (!$objEmployee->getVal('firstname'))) {
                                $objEmployee->set('gender_id', $this->getVal('gender_id'));
                                $objEmployee->set('country_id', $this->getVal('country_id'));
                                $objEmployee->set('firstname', $this->getVal('firstname'));
                                $objEmployee->set('f_firstname', $this->getVal('f_firstname'));
                                $objEmployee->set('g_f_firstname', $this->getVal('g_f_firstname'));
                                $objEmployee->set('lastname', $this->getVal('lastname'));
                                $objEmployee->set('firstname_en', $this->getVal('firstname_en'));
                                $objEmployee->set('f_firstname_en', $this->getVal('f_firstname_en'));
                                $objEmployee->set('g_f_firstname_en', $this->getVal('g_f_firstname_en'));
                                $objEmployee->set('lastname_en', $this->getVal('lastname_en'));
                                $objEmployee->set('mobile', $this->getVal('mobile'));
                        }

                        $domain_id = Domain::$DOMAIN_BUSINESS_MANAGEMENT_SYSTEM;
                        $hierarchy_level_enum = $this->getVal('hierarchy_level_enum');
                        $objEmployee->set('domain_id', $domain_id);

                        $wroleList = $this->get('wrole_mfk');
                        foreach ($wroleList as $wroleItem) {
                                $jobroleArr = explode(',', trim($wroleItem->getVal('jobrole_mfk'), ','));
                                foreach ($jobroleArr as $jobroleId) {
                                        $objEmployee->addMeThisJobrole($jobroleId);
                                }
                        }
                        $objEmployee->commit();
                        $inf_arr[] = $objEmployee->translate('jobrole_mfk', $lang) . ' : ' . $objEmployee->decode('jobrole_mfk', '', false, $lang);
                        list($err, $inf, $war) = $objEmployee->updateMyUserInformation();

                        if ($err)
                                $err_arr[] = $err;
                        if ($inf)
                                $inf_arr[] = $inf;
                        if ($war)
                                $war_arr[] = $war;
                        // if($tech) $tech_arr[] = $tech;

                        // die('xxx1  rafik : err_arr=' . implode(',', $err_arr) . ' inf_arr=' . implode(',', $inf_arr) . ' war_arr = ' . implode(',', $war_arr));

                        $auserObj = $objEmployee->het('auser_id');
                        if ($auserObj) {
                                $auserObj->set('hierarchy_level_enum', $hierarchy_level_enum);
                                $auserObj->commit();
                        }

                        list($err, $inf, $war) = $auserObj->generateCacheFile($lang, false, true);
                        if ($err)
                                $err_arr[] = $err;
                        if ($inf)
                                $inf_arr[] = $inf;
                        if ($war)
                                $war_arr[] = $war;

                        $this->set('employee_id', $objEmployee->id);
                        if ($commit)
                                $this->commit();

                        $this->getPrevilegesPhpCodeForUser($lang);
                        list($err, $inf, $war) = WorkflowRequest::assignEmployeeForNonAssigned(false, $lang, 1000);
                        if ($err)
                                $err_arr[] = $err;
                        if ($inf)
                                $inf_arr[] = $inf;
                        if ($war)
                                $war_arr[] = $war;

                        return AfwFormatHelper::pbm_result($err_arr, $inf_arr, $war_arr, $sep = "<br>\n", $tech_arr);
                } else {
                        return ['No email defined for the workflow employee', ''];
                }
        }

        public function resetPassword($lang = 'ar', $password_sent_by = null, $message_prefix = '')
        {
                $objEmployee = $this->het('employee_id');
                if (!$objEmployee)
                        return [$this->tm('Failed to find the employee profile record', $lang), ''];
                $auserObj = $objEmployee->het('auser_id');
                if (!$auserObj)
                        return [$this->tm('Failed to find this system user', $lang), ''];
                return $auserObj->resetPassword($lang, $password_sent_by, $message_prefix);
        }

        public function getPrevilegesPhpCodeForUser($lang = 'ar')
        {
                $objEmployee = $this->het('employee_id');
                if (!$objEmployee)
                        return [$this->tm('Failed to find the employee profile record', $lang), ''];
                $auserObj = $objEmployee->het('auser_id');
                if (!$auserObj)
                        return [$this->tm('Failed to find this system user', $lang), ''];

                return $auserObj->getPrevilegesPhpCode($lang);
        }

        public function calcPrivilegeCode($what = 'value')
        {
                $objEmployee = $this->het('employee_id');
                if (!$objEmployee)
                        return '????';
                /** @var Auser $auserObj */
                $auserObj = $objEmployee->het('auser_id');
                if (!$auserObj)
                        return '!!!!';

                return $auserObj->calcShowPhpCode($what);
        }

        public function beforeDelete($id, $id_replace)
        {
                if ($id) {
                        if ($id_replace == 0) {
                                $server_db_prefix = AfwSession::config('db_prefix', 'default_db_');  // FK part of me - not deletable

                                $server_db_prefix = AfwSession::config('db_prefix', 'default_db_');  // FK part of me - deletable

                                // FK not part of me - replaceable

                                // MFK
                        } else {
                                $server_db_prefix = AfwSession::config('db_prefix', 'default_db_');  // FK on me

                                // MFK
                        }
                        return true;
                }
        }

        public function calcWorkflow_orgunit_id()
        {
                if (!$this->getVal('orgunit_id'))
                        return null;
                $obj = WorkflowOrgunit::loadByMainIndex($this->getVal('orgunit_id'));
                return $obj;
        }

        public function calcWorkflowRequests_count($only_done = false, $ongoing_only = false)
        {
                if (!$this->getVal('employee_id'))
                        return null;

                $employee_id = $this->getVal('employee_id');
                $orgunit_id = $this->getVal('orgunit_id');

                $obj = new WorkflowRequest();
                $obj->select('employee_id', $employee_id);
                $obj->select('orgunit_id', $orgunit_id);

                if ($only_done)
                        $obj->where("done='Y'");
                elseif ($ongoing_only)
                        $obj->where("done!='Y'");

                return $obj->count();
        }

        public function calcDone_requests_count($satisfied_only = false, $surveyed_only = false)
        {
                return $this->calcWorkflowRequests_count($only_done = true, $ongoing_only = false, $satisfied_only, $surveyed_only);
        }

        public function calcDoneSurveyed_requests_count($satisfied_only = false)
        {
                return $this->calcDone_requests_count($satisfied_only, $surveyed_only = true);
        }

        public function calcDoneSurveyedSatisfied_requests_count()
        {
                return $this->calcDoneSurveyed_requests_count($satisfied_only = true);
        }

        public function calcOngoing_requests_count($satisfied_only = false, $surveyed_only = false)
        {
                return $this->calcWorkflowRequests_count($only_done = false, $ongoing_only = true, $satisfied_only, $surveyed_only);
        }

        public function calcInbox_count()
        {
                if (!$this->getVal('employee_id'))
                        return null;
                return WorkflowRequest::inboxCountFor($this->getVal('employee_id'));
        }

        public function calcStatif_pct()
        {
                $all_count = $this->calcDoneSurveyed_requests_count();
                if (!$all_count)
                        return null;
                $satisfied_only_count = $this->calcDoneSurveyedSatisfied_requests_count();

                return round($satisfied_only_count * 100 / $all_count);
        }

        public static function getCommiteeArray($orgunit_id, $commitee_id)
        {
                $obj = new WorkflowEmployee();
                // $obj->select_visibilite_horizontale();
                $obj->select('orgunit_id', $orgunit_id);
                $obj->select('commitee_id', $commitee_id);
                $obj->select('active', 'Y');

                return $obj->loadMany();
        }

        public static function getCommiteeList($orgunit_id, $commitee_id)
        {
                $objList = self::getCommiteeArray($orgunit_id, $commitee_id);

                $supervList = array();

                foreach ($objList as $objItem) {
                        $supervList[$objItem->getVal('employee_id')] = array('obj' => $objItem, 'curr' => 0);  // ->getDisplay("ar")
                }
                return $supervList;
        }

        /*
         * public static function isAdmin($employee_id)
         * {
         *         $obj = new WorkflowEmployee();
         *         $obj->select("admin","Y");
         *         $obj->select("employee_id",$employee_id);
         *         $obj->load();
         *         return $obj->id;
         *
         * }
         *
         *
         * public static function isGeneralAdmin($employee_id)
         * {
         *         $obj = new WorkflowEmployee();
         *         $obj->select("super_admin","Y");
         *         $obj->select("employee_id",$employee_id);
         *         $obj->load();
         *         return $obj->id;
         *
         * }
         */

        public static function getEmployeeListOfIds($orgunit_id, $wscope_id)
        {
                $empList = self::getEmployeeList($orgunit_id, $wscope_id);

                $empListIds = array();
                foreach ($empList as $id => $empObj) {
                        $empListIds[] = $empObj->id;
                }

                return array($empListIds, $empList);
        }

        public static function getEmployeeList($orgunit_id, $wscope_id, $except_employee_id = 0)
        {
                $obj = new WorkflowEmployee();
                if (!$orgunit_id)
                        throw new AfwRuntimeException('getEmployeeList need a correct and valid orgunit_id');
                // $obj->select_visibilite_horizontale();
                $obj->select('orgunit_id', $orgunit_id);
                $obj->select('active', 'Y');
                $obj->where("employee_id != $except_employee_id and wrole_mfk like '%,1,%' and wscope_mfk like '%,$wscope_id,%'");

                $objList = AfwLoadHelper::loadList($obj, 'employee_id');

                return $objList;
        }

        public static function getEmployeeArray($orgunit_id, $wscope_id, $except_employee_id = 0, $accepted_roles = [1])
        {
                $obj = new WorkflowEmployee();
                if (!$orgunit_id)
                        $obj->simpleError('getEmployeeList need a correct and valid orgunit_id');
                // $obj->select_visibilite_horizontale();
                $obj->select('orgunit_id', $orgunit_id);
                $obj->select('active', 'Y');
                $obj->where("employee_id != $except_employee_id");
                $obj->where("wrole_mfk like '%," . implode(",%' or wrole_mfk like '%,", $accepted_roles) . ",%'");
                $obj->where("and wscope_mfk like '%,$wscope_id,%'");

                $objList = $obj->loadMany();

                $empList = array();

                foreach ($objList as $objItem) {
                        $empList[$objItem->getVal('employee_id')] = array('obj' => $objItem, 'curr' => 0);  // ->getDisplay("ar")
                }
                return $empList;
        }

        public static function orgOfEmployee($employee_id, $return_object = false, $return_id = true)
        {
                if (!self::$orgListOfEmployee[$employee_id]) {
                        $obj = new WorkflowEmployee();
                        // $obj->select_visibilite_horizontale();
                        $obj->select('employee_id', $employee_id);
                        $obj->select('active', 'Y');

                        self::$orgListOfEmployee[$employee_id] = AfwLoadHelper::loadList($obj, 'orgunit_id');
                }

                $objList = self::$orgListOfEmployee[$employee_id];

                if (count($objList) == 1) {
                        foreach ($objList as $objItem) {
                                if ($return_object)
                                        return $objItem;
                                elseif ($return_id)
                                        return $objItem->id;
                                else {
                                        $lang = AfwSession::getSessionVar('current_lang');
                                        if (!$lang)
                                                $lang = 'ar';
                                        return AfwLanguageHelper::tt('موظف القبول في') . ' ' . $objItem->getDisplay($lang);
                                }
                        }
                } elseif (count($objList) > 1) {
                        if ($return_object)
                                return null;
                        elseif ($return_id)
                                return 0;
                        else {
                                $lang = AfwSession::getSessionVar('lang');
                                if (!$lang)
                                        $lang = 'ar';
                                return "<div class='workflow-warning'><!-- empId=$employee_id -->" . AfwLanguageHelper::tt('معين في أكثر من إدارة قبول', $lang) . '</div>';
                        }
                } else {
                        if ($return_object)
                                return null;
                        elseif ($return_id)
                                return 0;
                        else {
                                $lang = AfwSession::getSessionVar('lang');
                                if (!$lang)
                                        $lang = 'ar';
                                return "<div class='workflow-warning'><!-- empId=$employee_id -->" . AfwLanguageHelper::tt('غير معين في إدارة قبول', $lang) . '</div>';
                        }
                }
        }

        public static function getBestAvailableEmployee($orgunit_id, $wscope_id, $except_employee_id = 0, $strict = false, $accepted_roles = [1])
        {
                $employeeList = self::getEmployeeArray($orgunit_id, $wscope_id, $except_employee_id, $accepted_roles);
                if ($except_employee_id)
                        unset($employeeList[$except_employee_id]);
                else
                        $except_employee_id = 0;
                // AfwRunHelper::safeDie("employeeList = ".var_export($employeeList,true));
                $stats_arr = WorkflowRequest::aggreg(
                        $function = 'count(*)',
                        $where = " active='Y' 
                                                                                and done != 'Y'
                                                                                and orgunit_id=$orgunit_id 
                                                                                and employee_id > 0 
                                                                                and employee_id != $except_employee_id",
                        $group_by = 'employee_id',
                        $throw_error = true,
                        $throw_analysis_crash = true
                );

                $sql = "select $function from workflow_request where $where group by $group_by ";
                // AfwRunHelper::safeDie("stats_arr = ".var_export($stats_arr,true));
                $best_employee_id = 0;
                if (count($stats_arr) > 0) {
                        $min_curr_count = 99999;

                        foreach ($stats_arr as $employee_id => $curr_count) {
                                $employeeList[$employee_id]['curr'] = $curr_count;
                                if ($employeeList[$employee_id]['obj']) {
                                        if ($curr_count < $min_curr_count) {
                                                $min_curr_count = $curr_count;
                                                $best_employee_id = $employee_id;
                                        } elseif ($curr_count == $min_curr_count) {
                                                if ($strict)
                                                        $best_employee_id = 0;
                                        }
                                }
                        }
                }

                // but if one employee doesn't have any previous request assigned he will not be in $stats_arr
                // he should be the best employee because he have no request assigned, so check this :
                foreach ($employeeList as $employee_id => $employeeItem) {
                        if (!$employeeItem['curr'])
                                $best_employee_id = $employee_id;
                }

                if (!$strict) {
                        if ((!$best_employee_id) or (!$employeeList[$best_employee_id]['obj'])) {
                                reset($employeeList);
                                $first_item = current($employeeList);
                                // AfwRunHelper::safeDie("first_item = ".var_export($first_item,true)." employeeList = ".var_export($employeeList,true));
                                if ($first_item['obj'])
                                        $best_employee_id = $first_item['obj']->getVal('employee_id');
                        }
                }

                if ($best_employee_id)
                        $return = $employeeList[$best_employee_id];
                else
                        $return = null;

                $log = "strict=$strict sql=$sql stats_arr = " . var_export($stats_arr, true);
                // die("best_employee_id = $best_employee_id , return = ".var_export($return,true).", employeeList = ".var_export($employeeList,true));

                return array($best_employee_id, $return, $employeeList, $log);
        }

        /*
         * public static function getBestAvailableCommitee($orgunit_id, $except_supervisor_id=0, $re_distribution=false)
         * {
         *         global $allCommiteeList;
         *         if(!$allCommiteeList) $allCommiteeList = self::getCommiteeList($orgunit_id);
         *         $supervisorList = $allCommiteeList;
         *         if($except_supervisor_id) unset($supervisorList[$except_supervisor_id]);
         *         else $except_supervisor_id=0;
         *         // AfwRunHelper::safeDie("supervisorList = ".var_export($supervisorList,true));
         *         $best_supervisor_id = 0;
         *
         *
         *         $stats_arr = WorkflowRequest::aggreg($function="count(*)", $where="active='Y' and status_id in (".WorkflowRequest::$REQUEST_STATUSES_ONGOING_SUPERVISOR.") and super visor_id > 0 and super visor_id != $except_supervisor_id", $group_by = "supe rvisor_id",$throw_error=true, $throw_analysis_crash=true);
         *         if(count($stats_arr)>0)
         *         {
         *                 foreach($stats_arr as $superv_id => $curr_count)
         *                 {
         *                         $supervisorList[$superv_id]["curr"] = $curr_count;
         *                 }
         *         }
         *
         *
         *
         *         $min_curr_count = 99999;
         *
         *         foreach($supervisorList as $superv_id => $supervisorRow)
         *         {
         *                 $curr_count = $supervisorRow["curr"];
         *                 if(($curr_count < $min_curr_count) and ($supervisorRow["obj"]))
         *                 {
         *                         $min_curr_count = $curr_count;
         *                         $best_supervisor_id = $superv_id;
         *                 }
         *         }
         *
         *
         *         if((!$best_supervisor_id) or (!$supervisorList[$best_supervisor_id]["obj"]))
         *         {
         *                 reset($supervisorList);
         *                 $first_item = current($supervisorList);
         *                 // AfwRunHelper::safeDie("first_item = ".var_export($first_item,true)." supervisorList = ".var_export($supervisorList,true));
         *                 if($first_item["obj"]) $best_supervisor_id = $first_item["obj"]->getVal("employee_id");
         *         }
         *
         *         if($best_supervisor_id) $return = $supervisorList[$best_supervisor_id];
         *         else $return = null;
         *
         *         // AfwRunHelper::safeDie("best_supervisor_id = $best_supervisor_id , return = ".var_export($return,true));
         *
         *         return array($best_supervisor_id, $return, $supervisorList, $stats_arr);
         *
         *
         *
         *
         * }
         *
         *
         * public function assignMeAsWorkflowRequestCommitee($requestObj, $commit = true) // , $orgunit_id
         * {
         *         // $requestObj->set("orgunit_id", $orgunit_id);
         *         $requestObj->set("superv isor_id", $this->getVal("employee_id"));
         *         if($commit) $requestObj->commit();
         * }
         */

        /**
         * @param WorkflowRequest $requestObj
         */
        public function assignMeOnWorkflowRequest($requestObj, $lang = 'ar')
        {
                list($err, $info) = $requestObj->assignRequest($this->getVal('employee_id'), $lang);
                if ($err)
                        AfwSession::pushError($err);
                if ($info)
                        AfwSession::pushInformation($info);
        }

        public function calcArchive_date()
        {
                return AfwDateHelper::shiftHijriDate('', -180);
        }

        protected function hideNonActiveRowsFor($auser)
        {
                if (!$auser)
                        return true;
                if (WorkflowObject::userIsSuperAdmin($auser))
                        return false;
                if ($auser->isAdmin())
                        return false;
                return true;
        }

        public function shouldBeCalculatedField($attribute)
        {
                return false;
        }

        public function myShortNameToAttributeName($attribute)
        {
                if ($attribute == 'employee')
                        return 'employee_id';

                return $attribute;
        }

        public static function notifyWorkflowEmployees($silent = false, $lang = 'ar')
        {
                $server_db_prefix = AfwSession::config('db_prefix', 'default_db_');
                $sql_inbox = "select orgunit_id, employee_id, count(*) as waiting from $server_db_prefix" . 'workflow.request where status_id in (201,4) group by orgunit_id, employee_id order by count(*) desc';
                // $sql_inbox .= " limit 30";

                $inbox_data = AfwDatabase::db_recup_rows($sql_inbox);

                $errors_arr = array();
                $infos_arr = array();

                foreach ($inbox_data as $inbox_row) {
                        $token_arr = [];
                        $token_arr['[waiting]'] = $inbox_row['waiting'];
                        $token_arr['[workflow_site_url]'] = AfwSession::config('workflow_site_url', '[workflow-site]');
                        $token_arr['[workflow_general_admin]'] = AfwSession::config('workflow_general_admin', 'rboubaker@ttc.gov.sa');

                        $workflowEmployeeObj = WorkflowEmployee::loadByMainIndex($inbox_row['orgunit_id'], $inbox_row['employee_id']);
                        list($err, $info) = $workflowEmployeeObj->notifyMe($lang, $token_arr);
                        if ($err)
                                $errors_arr[] = $err;
                        if ($info)
                                $infos_arr[] = $info;
                }

                $nb_errs = count($errors_arr);

                $infos_arr[] = 'notified ' . count($inbox_data) . " employee(s) with $nb_errs error(s)";

                if ((!$silent) and (count($errors_arr) > 0)) {
                        AfwSession::pushError(implode('<br>', $errors_arr));
                }

                if ((!$silent) and (count($infos_arr) > 0)) {
                        AfwSession::pushInformation(implode('<br>', $infos_arr));
                }

                return AfwFormatHelper::pbm_result($errors_arr, $infos_arr);
        }

        public function notifyMe($lang = 'ar', $token_arr = [])
        {
                $employeeObj = $this->het('employee_id');
                if (!$employeeObj)
                        return ['This workflow employee has no hrm employee defined : workflow-employee-id=' . $this->id, ''];

                $my_employee_id = $employeeObj->id;
                if (count($token_arr) == 0) {
                        $token_arr = [];
                        $server_db_prefix = AfwSession::config('db_prefix', 'default_db_');
                        $sql_inbox = "select orgunit_id, employee_id, count(*) as waiting from $server_db_prefix" . "workflow.request where employee_id = $my_employee_id and status_id in (201,4) group by orgunit_id, employee_id";

                        $inbox_row = AfwDatabase::db_recup_row($sql_inbox);
                        $token_arr['[waiting]'] = $inbox_row['waiting'];
                        $token_arr['[workflow_site_url]'] = AfwSession::config('workflow_site_url', '[workflow-site]');
                        $token_arr['[workflow_general_admin]'] = AfwSession::config('workflow_general_admin', 'rboubaker@ttc.gov.sa');
                }

                $token_arr['[the_orgunit]'] = $this->showAttribute('orgunit_id', null, true, $lang);

                $errors_arr = array();
                $infos_arr = array();

                $notify_employee_arr = AfwSession::config('notify_employee', null);
                $notify_employee_daily_waiting_requests_settings = $notify_employee_arr['daily_waiting_requests'];
                $development_mode = AfwSession::devMode();
                $receiver = array();

                $receiver['mobile'] = $employeeObj->getVal('mobile');
                $receiver['email'] = $employeeObj->getVal('email');
                // $receiver["mobile"] = "0598988330";
                // $receiver["email"] = "rboubaker@ttc.gov.sa";

                // $cc_to = "rboubaker@ttc.gov.sa";
                $cc_to = null;

                $file_dir_name = dirname(__FILE__);

                $from_template_file = "$file_dir_name/../tpl/template_[notification_type]_[notification_code].php";

                $receiver_label = $receiver['email'] . '/' . $receiver['mobile'];
                $notification_sender_result_arr = AfwNotificationManager::sendNotification($notify_employee_daily_waiting_requests_settings, $receiver, 'waiting_requests_notification', $employeeObj, $lang, $from_template_file, $token_arr, $cc_to);
                foreach ($notification_sender_result_arr as $notification_type => $notification_sender_result_item) {
                        $notification_sender_result_ok = $notification_sender_result_item[0];
                        $notification_sender_result_message = $notification_sender_result_item[1];
                        $notification_message = $notification_sender_result_item[2];
                        if (!$notification_sender_result_ok) {
                                $notif_error = $this->tr($notification_type) . ' &larr; ' . $notification_message . ' &larr; ' . $notification_sender_result_message;
                                if ($development_mode)
                                        AfwSession::pushError($notif_error);
                                $errors_arr[] = $notif_error;
                        } else {
                                $notif_info = $this->tr($notification_type) . ' &larr; ' . $notification_message . ' &larr; ' . $notification_sender_result_message . " >> sent successfully to $receiver_label";
                                $infos_arr[] = $notif_info;
                        }
                }

                return AfwFormatHelper::pbm_result($errors_arr, $infos_arr);
        }
}
