<?php
class WorkflowCommiteeMember extends WorkflowObject
{

        public static $DATABASE                = "";
        public static $MODULE                    = "workflow";
        public static $TABLE                        = "workflow_commitee_member";
        public static $DB_STRUCTURE = null;
        // public static $copypast = true;

        public function __construct()
        {
                parent::__construct("workflow_commitee_member", "id", "workflow");
                WorkflowWorkflowCommiteeMemberAfwStructure::initInstance($this);
        }

        public static function loadById($id)
        {
                $obj = new WorkflowCommiteeMember();

                if ($obj->load($id)) {
                        return $obj;
                } else return null;
        }

        public static function loadByMainIndex($workflow_commitee_id, $employee_id, $create_obj_if_not_found = false)
        {
                if (!$workflow_commitee_id) throw new AfwRuntimeException("loadByMainIndex : workflow_commitee_id is mandatory field");
                if (!$employee_id) throw new AfwRuntimeException("loadByMainIndex : employee_id is mandatory field");


                $obj = new WorkflowCommiteeMember();
                $obj->select("workflow_commitee_id", $workflow_commitee_id);
                $obj->select("employee_id", $employee_id);

                if ($obj->load()) {
                        if ($create_obj_if_not_found) $obj->activate();
                        return $obj;
                } elseif ($create_obj_if_not_found) {
                        $obj->set("workflow_commitee_id", $workflow_commitee_id);
                        $obj->set("employee_id", $employee_id);

                        $obj->insertNew();
                        if (!$obj->id) return null; // means beforeInsert rejected insert operation
                        $obj->is_new = true;
                        return $obj;
                } else return null;
        }

        public function getDisplay($lang = 'ar')
        {
                return $this->getDefaultDisplay($lang);
        }

        public function stepsAreOrdered()
        {
                return false;
        }

        public function refreshMyWorkflowEmployeeRolesAndScopes($lang = 'ar')
        {
                /**
                 * @var WorkflowCommitee $commObj
                 */
                $commObj = $this->het("workflow_commitee_id");
                if ($commObj) {
                        $wscope_mfk = $commObj->calc("wscope_mfk");
                        // list($orgunitObj, $wOrgunitObj) = $commObj->getOrgunitInfos();
                        // $orgunitObj = $commObj->het("orgunit_id");
                        if ($commObj->getVal("orgunit_id")) {
                                $wEmplObj = WorkflowEmployee::loadByMainIndex($commObj->getVal("orgunit_id"), $this->getVal("employee_id"), true);
                                $wEmplObj->set("hierarchy_level_enum", 999);
                                $was = "roles was : " . $wEmplObj->getVal("wrole_mfk") . " scopes was : " . $wEmplObj->getVal("wscope_mfk");
                                $wEmplObj->addRemoveInMfk("wrole_mfk", [4], []);
                                $wEmplObj->set("wscope_mfk", $wscope_mfk);
                                $become = "roles become : " . $wEmplObj->getVal("wrole_mfk") . " scopes become : " . $wEmplObj->getVal("wscope_mfk");
                                // die($was . " " . $become);
                                $wEmplObj->commit();
                                $wEmplObj->resetPrevileges();
                        }
                }

                return ['', 'done'];
        }

        public function getMyWorkflowUnitAndEmployee()
        {
                $commObj = $this->het("workflow_commitee_id");
                if (!$commObj) return [null, null];
                if (!$commObj->getVal("orgunit_id")) return [$commObj, null];
                $wEmplObj = WorkflowEmployee::loadByMainIndex($commObj->getVal("orgunit_id"), $this->getVal("employee_id"));

                return [$commObj, $wEmplObj];
        }



        public function afterInsert($id, $fields_updated, $disableAfterCommitDBEvent = false)
        {
                $this->refreshMyWorkflowEmployeeRolesAndScopes();

                return parent::afterInsert($id, $fields_updated, $disableAfterCommitDBEvent);
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
                                list($commObj, $wEmplObj) =  $this->getMyWorkflowUnitAndEmployee();

                                if ($commObj and $wEmplObj and ($wEmplObj->id > 0)) {
                                        if ($commObj->getVal("secretary_employee_id") == $wEmplObj->id) {
                                                $commObj->setForce("secretary_employee_id", 0);
                                                $commObj->commit();
                                        }
                                        $wEmplObj->delete();
                                }


                                // FK part of me - deletable 


                                // FK not part of me - replaceable 



                                // MFK

                        } else {
                                // FK on me 


                                // MFK


                        }
                        return true;
                }
        }

        protected function getPublicMethods()
        {

                $pbms = array();

                $color = "orange";
                $title_en = "refresh my roles and programs";
                $title_ar = $this->tm($title_en, 'ar');
                $methodName = "refreshMyWorkflowEmployeeRolesAndScopes";
                $pbms[AfwStringHelper::hzmEncode($methodName)] = array(
                        "METHOD" => $methodName,
                        "COLOR" => $color,
                        "LABEL_AR" => $title_ar,
                        "LABEL_EN" => $title_en,
                        "ADMIN-ONLY" => true,
                        "BF-ID" => "",
                        'STEPS' => 'all'
                );

                return $pbms;
        }
}
