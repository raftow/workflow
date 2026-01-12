<?php
// ------------------------------------------------------------------------------------


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
                        // no VH requested for the moment
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
                /*
                if ($mode == 'mode_tempEmployeeList') {
                        unset($link);
                        $link = array();
                        $title = 'إضافة طلب تعي ين موظف قبول ';
                        $title_detailed = $title . 'لـ : ' . $displ;
                        $link['URL'] = "main.php?Main_Page=afw_mode_edit.php&cl=WorkflowEmpRequest&currmod=workflow&sel_orgunit_id=$orgunit_id";
                        $link['TITLE'] = $title;
                        $link['TARGET'] = 'newEmployeeRequest';
                        $link['PUBLIC'] = true;
                        $link['UGROUPS'] = array();
                        $link['ATTRIBUTE_WRITEABLE'] = 'tempEmployeeList';
                        $otherLinksArray[] = $link;
                }*/

                return $otherLinksArray;
        }

        protected function getPublicMethods()
        {
                $pbms = array();

                $color = 'orange';
                $title_ar = 'إعادة توزيع الطلبات على موظفي القبول';
                $methodName = 'resetRequestAssignement';
                $pbms[AfwStringHelper::hzmEncode($methodName)] = array(
                        'METHOD' => $methodName,
                        'COLOR' => $color,
                        'LABEL_AR' => $title_ar,
                        'PUBLIC' => true,
                        'ROLES' => 'workflow/393',
                        'HZM-SIZE' => 12,
                        // 'STEP' => $this->stepOfAttribute('currentRequests'),

                );



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
                $err_arr = [];
                $inf_arr = [];
                $war_arr = [];
                $tech_arr = [];
                function getPrioEmployee($inbox_list)
                {
                        $count_curr = 999999;
                        $employee_selected_id = 0;
                        foreach ($inbox_list as $empl_id => $count) {
                                if ($count < $count_curr) {
                                        $count_curr = $count;
                                        $employee_selected_id = $empl_id;
                                }
                        }

                        return $employee_selected_id;
                }

                $scopeArr = WorkflowScope::loadAllLookupObjects();
                $wroleArr = WorkflowRole::loadAllLookupObjects();
                foreach ($wroleArr as $wrole_id => $wroleObj) {

                        $requests_sql_cond_for_wrole = WorkflowTransition::requestsCanBeTransittedByWRoleSqlCondition($wrole_id);
                        foreach ($scopeArr as $wscope_id => $wscopeObj) {

                                unset($inbox_arr);
                                $inbox_arr = array();
                                // unassign request assigned to non active / non convenient employees
                                list($arrEmployee, $listEmployee) = WorkflowEmployee::getEmployeeListOfIds($this->getVal('orgunit_id'), $wscope_id, 0, [$wrole_id]);
                                $arrEmployee[] = 0;
                                $arrEmployeeTxt = implode(',', $arrEmployee);
                                $obj = new WorkflowRequest();
                                $obj->select('orgunit_id', $this->getVal('orgunit_id'));
                                $obj->select('workflow_scope_id', $wscope_id);
                                $obj->where($requests_sql_cond_for_wrole);
                                if ($reset) {
                                        $obj->where("done = 'N'");
                                } else {
                                        $obj->where("done = 'N' and (employee_id is null or employee_id not in ($arrEmployeeTxt))");
                                }

                                $obj->setForce('employee_id', 0);
                                // $status_comment = 'requestAssignement reset=' . $reset;
                                // $this->setForce('status_comment', $status_comment);

                                $nb_resetted = $obj->update(false);
                                $inf_arr[] = "For w-role $wrole_id w-scope $wscope_id $nb_resetted requests assigned";
                                // prepare array of inbox count for each of them to be equitable
                                // on requests distribution

                                foreach ($listEmployee as $objEmployee) {
                                        $inbox_arr[$objEmployee->id] = WorkflowRequest::inboxCountFor($objEmployee->id);
                                }


                                unset($obj);
                                $obj = new WorkflowRequest();
                                $obj->select('orgunit_id', $this->getVal('orgunit_id'));
                                $obj->select('workflow_scope_id', $wscope_id);
                                $obj->where($requests_sql_cond_for_wrole);
                                $obj->where("done = 'N' and employee_id = 0");
                                $nb_assigned = 0;
                                $nb_ignored = 0;
                                $requestWaitingList = $obj->loadMany();
                                /** @var WorkflowRequest $requestWaitingObj */
                                foreach ($requestWaitingList as $requestWaitingObjId => $requestWaitingObj) {
                                        $employee_to_assign = getPrioEmployee($inbox_arr);
                                        if ($employee_to_assign > 0) {
                                                $requestWaitingObj->assignRequest($employee_to_assign, $lang, 'Y');
                                                $nb_assigned++;
                                                $inbox_arr[$employee_to_assign]++;
                                        } else {
                                                $err_arr[] = "For request $requestWaitingObjId w-role $wrole_id w-scope $wscope_id No employee available to assign";
                                                $tech_arr[] = "Inbox_arr = " . var_export($inbox_arr, true);
                                                $nb_ignored++;
                                        }
                                }

                                $inf_arr[] = "For w-role $wrole_id w-scope $wscope_id $nb_assigned requests assigned, $nb_ignored requests ignored. ";
                        }

                        // die("inbox count by employee : ".var_export($inbox_arr,true));


                }

                return AfwFormatHelper::pbm_result($err_arr, $inf_arr, $war_arr, "<br>\n", $tech_arr);

                //$nb_resetted . ' ' . AfwLanguageHelper::tarjemMessage("request's reset", 'workflow', $lang) . ', ' . $nb_assigned . ' ' . AfwLanguageHelper::tarjemMessage("request's assign", 'workflow', $lang)

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

        /*
        public function getBestAvailEmployee($lang = 'ar')
        {
                $wscope_id = ??
                list($idobj, $item, $listObj, $log) = WorkflowEmployee::getBestAvailableEmployee($this->getVal('orgunit_id'), $wscope_id, 0);
                $obj = $item['obj'];

                if ($obj)
                        $result = $obj->getDisplay($lang);
                else
                        $result = $this->tm('No employee is available', $lang);

                return array('', $result, $log);
        }*/

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
