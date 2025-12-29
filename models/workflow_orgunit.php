<?php
// ------------------------------------------------------------------------------------
// 6/6/2022 rafik :

// mysql> alter table workflow_orgunit change service_mfk service_mfk varchar(255) NOT NULL DEFAULT ',1,';
// mysql> alter table workflow_orgunit change service_category_mfk service_category_mfk varchar(255) NOT NULL DEFAULT ',1,';

$file_dir_name = dirname(__FILE__);

// old include of afw.php

class WorkflowOrgunit extends WorkflowObject
{
        public static $MY_ATABLE_ID = 3614;
        public static $MAIN_CUSTOMER_SERVICE_DEPARTMENT_ID = 70;
        public static $DATABASE = '';
        public static $MODULE = 'workflow';
        public static $TABLE = 'workflow_orgunit';
        public static $DB_STRUCTURE = null;

        public function __construct()
        {
                parent::__construct('workflow_orgunit', 'id', 'workflow');
                WorkflowWorkflowOrgunitAfwStructure::initInstance($this);
        }

        public function select_visibilite_horizontale($dropdown = false)
        {
                $objme = AfwSession::getUserConnected();

                if ($objme and $objme->isAdmin()) {
                        // no VH for system admin
                } else {
                        $empl_id = $objme ? $objme->getEmployeeId() : 0;

                        if ($empl_id)
                                $iam_general_supervisor = WorkflowObject::userIsSuperAdmin();
                        if ($empl_id)
                                $iam_supervisor = WorkflowObject::userIsAdmin();

                        if (!$iam_general_supervisor)
                                $iam_general_supervisor = 0;
                        if (!$iam_supervisor)
                                $iam_supervisor = 0;

                        // if the user is an employee
                        // he is allowed to see orgunit if :
                        // 1. he is a general supervisor
                        // or
                        // 2. he is a supervisor

                        $employee_allowed_to_see_orgunit_cond =
                                "($iam_general_supervisor>0 or $iam_supervisor>0)";

                        $this->where("($empl_id>0 and $employee_allowed_to_see_orgunit_cond)");
                }

                $selects = array();
                $this->select_visibilite_horizontale_default($dropdown, $selects);
        }

        public static function loadById($id)
        {
                $obj = new WorkflowOrgunit();
                $obj->select_visibilite_horizontale();
                if ($obj->load($id)) {
                        return $obj;
                } else
                        return null;
        }

        /**
         * @return WorkflowOrgunit:
         */
        public static function loadByCode($code)
        {
                list($a, $orgunit_id) = explode('-', $code);
                return WorkflowOrgunit::loadByMainIndex($orgunit_id);
        }

        /**
         * @return WorkflowOrgunit:
         */
        public static function loadByMainIndex($orgunit_id, $create_obj_if_not_found = false)
        {
                $obj = new WorkflowOrgunit();
                if (!$orgunit_id)
                        $obj->simpleError('loadByMainIndex : orgunit_id is mandatory field');

                $obj->select('orgunit_id', $orgunit_id);

                if ($obj->load()) {
                        if ($create_obj_if_not_found)
                                $obj->activate();
                        return $obj;
                } elseif ($create_obj_if_not_found) {
                        $obj->set('orgunit_id', $orgunit_id);

                        $obj->insert();
                        $obj->is_new = true;
                        return $obj;
                } else
                        return null;
        }

        public function getDisplay($lang = 'ar')
        {
                $data = array();
                $link = array();

                list($data[0], $link[0]) = $this->displayAttribute('orgunit_id', false, $lang);

                return implode(' - ', $data);
        }

        protected function getOtherLinksArray($mode, $genereLog = false, $step = 'all')
        {
                global $me, $objme, $lang;
                $otherLinksArray = $this->getOtherLinksArrayStandard($mode, false, $step);
                $my_id = $this->getId();
                $orgunit_id = $this->getVal('orgunit_id');
                $displ = $this->getDisplay($lang);

                if ($mode == 'mode_allEmployeeList') {
                        unset($link);
                        $link = array();
                        $title = 'إضافة موظف قبول ';
                        $title_detailed = $title . 'لـ : ' . $displ;
                        $link['URL'] = "main.php?Main_Page=afw_mode_edit.php&cl=WorkflowEmployee&currmod=workflow&sel_orgunit_id=$orgunit_id";
                        $link['TITLE'] = $title;
                        $link['TARGET'] = 'newEmployee';
                        $link['PUBLIC'] = true;
                        $link['UGROUPS'] = array();
                        $link['ATTRIBUTE_WRITEABLE'] = 'allEmployeeList';
                        $otherLinksArray[] = $link;
                }

                if ($mode == 'mode_tempEmployeeList') {
                        unset($link);
                        $link = array();
                        $title = 'إضافة طلب تعيين موظف قبول ';
                        $title_detailed = $title . 'لـ : ' . $displ;
                        $link['URL'] = "main.php?Main_Page=afw_mode_edit.php&cl=WorkflowEmpRequest&currmod=workflow&sel_orgunit_id=$orgunit_id";
                        $link['TITLE'] = $title;
                        $link['TARGET'] = 'newEmployeeRequest';
                        $link['PUBLIC'] = true;
                        $link['UGROUPS'] = array();
                        $link['ATTRIBUTE_WRITEABLE'] = 'tempEmployeeList';
                        $otherLinksArray[] = $link;
                }

                return $otherLinksArray;
        }

        protected function getPublicMethods()
        {
                $pbms = array();
                $iam_general_supervisor = WorkflowObject::userIsSuperAdmin();
                if ($iam_general_supervisor) {
                        $color = 'green';
                        $title_ar = 'اسناد الطلبات إلى موظفي القبول';
                        $methodName = 'requestAssignement';
                        $pbms[AfwStringHelper::hzmEncode($methodName)] = array(
                                'METHOD' => $methodName,
                                'COLOR' => $color,
                                'LABEL_AR' => $title_ar,
                                'PUBLIC' => true,
                                'BF-ID' => '',
                                'HZM-SIZE' => 12,
                                'STEP' => $this->stepOfAttribute('currentRequests'),

                                /*
                                 * CONFIRMATION_NEEDED=>true,
                                 * 'CONFIRMATION_WARNING' =>array('ar' => "xxxxxx",
                                 *                                 'en' => "@todo"),
                                 * 'CONFIRMATION_QUESTION' =>array('ar' => "yyyyy",
                                 *                         'en' => "@todo"),
                                 * 'MODE' =>array("mode_diploma_approved"=>true),
                                 */
                        );

                        $color = 'orange';
                        $title_ar = 'إعادة توزيع الطلبات على موظفي القبول';
                        $methodName = 'resetRequestAssignement';
                        $pbms[AfwStringHelper::hzmEncode($methodName)] = array(
                                'METHOD' => $methodName,
                                'COLOR' => $color,
                                'LABEL_AR' => $title_ar,
                                'PUBLIC' => true,
                                'BF-ID' => '',
                                'HZM-SIZE' => 12,
                                'STEP' => $this->stepOfAttribute('currentRequests'),

                                /*
                                 * CONFIRMATION_NEEDED=>true,
                                 * 'CONFIRMATION_WARNING' =>array('ar' => "xxxxxx",
                                 *                                 'en' => "@todo"),
                                 * 'CONFIRMATION_QUESTION' =>array('ar' => "yyyyy",
                                 *                         'en' => "@todo"),
                                 * 'MODE' =>array("mode_diploma_approved"=>true),
                                 */
                        );

                        if ($this->getVal('orgunit_id') == WorkflowOrgunit::$MAIN_CUSTOMER_SERVICE_DEPARTMENT_ID) {
                                $color = 'blue';
                                $title_ar = 'اعادة توزيع الطلبات على مشرفي التنسيق';
                                $methodName = 'resetSupervisorAssignement';
                                $pbms[AfwStringHelper::hzmEncode($methodName)] = array(
                                        'METHOD' => $methodName,
                                        'COLOR' => $color,
                                        'LABEL_AR' => $title_ar,
                                        'PUBLIC' => true,
                                        'BF-ID' => '',
                                        'HZM-SIZE' => 12,
                                        'STEP' => $this->stepOfAttribute('currentRequests'),

                                        /*
                                         * CONFIRMATION_NEEDED=>true,
                                         * 'CONFIRMATION_WARNING' =>array('ar' => "xxxxxx",
                                         *                                 'en' => "@todo"),
                                         * 'CONFIRMATION_QUESTION' =>array('ar' => "yyyyy",
                                         *                         'en' => "@todo"),
                                         * 'MODE' =>array("mode_diploma_approved"=>true),
                                         */
                                );

                                $color = 'green';
                                $title_ar = 'توزيع الطلبات على مشرفي التنسيق';
                                $methodName = 'supervisorAssignement';
                                $pbms[AfwStringHelper::hzmEncode($methodName)] = array(
                                        'METHOD' => $methodName,
                                        'COLOR' => $color,
                                        'LABEL_AR' => $title_ar,
                                        'PUBLIC' => true,
                                        'BF-ID' => '',
                                        'HZM-SIZE' => 12,
                                        'STEP' => $this->stepOfAttribute('currentRequests'),

                                        /*
                                         * CONFIRMATION_NEEDED=>true,
                                         * 'CONFIRMATION_WARNING' =>array('ar' => "xxxxxx",
                                         *                                 'en' => "@todo"),
                                         * 'CONFIRMATION_QUESTION' =>array('ar' => "yyyyy",
                                         *                         'en' => "@todo"),
                                         * 'MODE' =>array("mode_diploma_approved"=>true),
                                         */
                                );
                        }

                        $color = 'orange';
                        $title_ar = 'أي موظفي القبول متوفر أكثر';
                        $methodName = 'getBestAvailEmployee';
                        $pbms[AfwStringHelper::hzmEncode($methodName)] = array(
                                'METHOD' => $methodName,
                                'COLOR' => $color,
                                'LABEL_AR' => $title_ar,
                                'ADMIN' => true,
                                'BF-ID' => '',
                                'HZM-SIZE' => 12,
                                'STEP' => $this->stepOfAttribute('allEmployeeList'),

                                /*
                                 * CONFIRMATION_NEEDED=>true,
                                 * 'CONFIRMATION_WARNING' =>array('ar' => "xxxxxx",
                                 *                         'en' => "@todo"),
                                 * 'CONFIRMATION_QUESTION' =>array('ar' => "yyyyy",
                                 *                         'en' => "@todo"),
                                 * 'MODE' =>array("mode_diploma_approved"=>true),
                                 */
                        );
                }

                return $pbms;
        }

        // also silentAssignSupervisorForNonAssigned($lang="ar")

        /*
         * public function resetSupervisorAssignement($lang="ar")
         * {
         *         WorkflowRequest::resetAssignSupervisors($lang="ar");
         * }
         *
         * public function supervisorAssignement($lang="ar")
         * {
         *         WorkflowRequest::silentAssignSupervisorForNonAssigned($lang="ar");
         * }
         */

        public function resetRequestAssignement($lang = 'ar')
        {
                return self::requestAssignement($lang, $reset = true);
        }

        public function requestAssignement($lang = 'ar', $reset = false)
        {
                // unassign request assigned to non active employees
                list($arrEmployee, $listEmployee) = WorkflowEmployee::getEmployeeListOfIds($this->getVal('orgunit_id'));
                $arrEmployee[] = 0;
                $arrEmployeeTxt = implode(',', $arrEmployee);
                $obj = new WorkflowRequest();
                $obj->select('orgunit_id', $this->getVal('orgunit_id'));
                if ($reset) {
                        // because not good to reassign ticket of employee who has started to work on it
                        // except if this employee has been dis-missioned
                        $obj->where("status_id in (1,2,) -- REQUEST_STATUSES_ASSIGNED_ONLY 
                                     or (status_id in (3,4,) -- REQUEST_STATUSES_ONGOING_ALL
                                          and (employee_id is null or employee_id not in ($arrEmployeeTxt)))");
                } else {
                        $obj->where("(status_id in (REQUEST_STATUSES_ONGOING_ALL) and (employee_id is null or employee_id not in ($arrEmployeeTxt)))");
                }

                $obj->setForce('employee_id', 0);
                $status_comment = 'requestAssignement reset=' . $reset;
                $this->setForce('status_comment', $status_comment);
                $nb_resetted = $obj->update(false);

                // prepare array of inbox count for each of them to be equitable
                // on requests distribution
                $inbox_arr = array();
                foreach ($listEmployee as $objEmployee) {
                        $inbox_arr[$objEmployee->id] = WorkflowRequest::inboxCountFor($objEmployee->id);
                }

                // die("inbox count by employee : ".var_export($inbox_arr,true));

                function getPrioEmployee($inbox_list)
                {
                        $count_curr = 999999;
                        $inv_selected_id = 0;
                        foreach ($inbox_list as $inv_id => $count) {
                                if ($count < $count_curr) {
                                        $count_curr = $count;
                                        $inv_selected_id = $inv_id;
                                }
                        }

                        return $inv_selected_id;
                }

                unset($obj);
                $obj = new WorkflowRequest();
                $obj->select('orgunit_id', $this->getVal('orgunit_id'));
                $obj->where('status_id in (REQUEST_STATUSES_ONGOING_ALL and (employee_id is null or employee_id = 0)');
                $nb_assigned = 0;
                $requestWaitingList = $obj->loadMany();
                /** @var WorkflowRequest $requestWaitingObj */
                foreach ($requestWaitingList as $requestWaitingObj) {
                        $employee_to_assign = getPrioEmployee($inbox_arr);
                        if ($employee_to_assign > 0) {
                                $requestWaitingObj->assignRequest($employee_to_assign, $lang, 'Y', 'requestAssignement automatic task');
                                $nb_assigned++;
                                $inbox_arr[$employee_to_assign]++;
                        }
                }

                return array('', $nb_resetted . ' ' . AfwLanguageHelper::tarjemMessage("request's reset", 'workflow', $lang) . ', ' . $nb_assigned . ' ' . AfwLanguageHelper::tarjemMessage("request's assign", 'workflow', $lang), '');
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

        /*
         * public function calcNew_requests_count()
         * {
         *         // all requests count
         *         return self::calcRequests_countFor($only_done=false, $ongoing_only=false, $new_only=true, $aborted_only=false);
         * }
         *
         * public function calcRequests_count()
         * {
         *         // all requests count
         *         return self::calcRequests_countFor($only_done=false, $ongoing_only=true, $new_only=false, $aborted_only=false);
         * }
         *
         * public function calcRequests_countFor($only_done=false, $ongoing_only=false, $new_only=false, $aborted_only=false)
         * {
         *     $obj = new WorkflowRequest();
         *     $obj->where("request_date >= '".$this->calcArchive_date()."'");
         *     if($this->getVal("orgunit_id") != WorkflowOrgunit::$MAIN_CUSTOMER_SERVICE_DEPARTMENT_ID)
         *     {
         *         $obj->select("orgunit_id", $this->getVal("orgunit_id"));
         *     }
         *
         *     if($new_only) $obj->where("supervis or_id = 0 or orgunit_id = 0");
         *     if($only_done) $obj->where("supervi sor_id > 0 and orgunit_id > 0 and status_id in (".WorkflowRequest::$REQUEST_STATUSES_DONE.")");
         *     if($ongoing_only) $obj->where("super visor_id > 0 and orgunit_id > 0 and status_id in (".WorkflowRequest::$REQUEST_STATUSES_ONGOING_ALL.")");
         *     if($aborted_only) $obj->where("super visor_id > 0 and orgunit_id > 0 and status_id in (".WorkflowRequest::$REQUEST_STATUSES_ABORTED.")");
         *
         *
         *    return $obj->count();
         * }
         */

        public function getBestAvailEmployee($lang = 'ar')
        {
                $res = WorkflowEmployee::getBestAvailableEmployee($this->getVal('orgunit_id'), 0);

                return array('', var_export($res, true));
        }

        public function calcArchive_date()
        {
                // 1 year and half (we should archive requests older than this date @todo this job)
                return AfwDateHelper::shiftHijriDate('', -540);
        }

        public function maxRecordsUmsCheck()
        {
                return 0;
        }

        public function attributeIsApplicable($attribute)
        {
                /*
                 * if (($attribute == "xxxx") or ($attribute == "yyyyy") or ($attribute == "zzzz")) {
                 *
                 * }
                 */

                return true;
        }
}
?>