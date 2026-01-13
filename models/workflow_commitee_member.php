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

        public function getDisplay($lang = 'ar')
        {
                return $this->getDefaultDisplay($lang);
        }

        public function stepsAreOrdered()
        {
                return false;
        }

        public function afterInsert($id, $fields_updated, $disableAfterCommitDBEvent = false)
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
                                $wEmplObj->set("wrole_mfk", ",4,");
                                $wEmplObj->set("wscope_mfk", $wscope_mfk);
                                $wEmplObj->commit();
                                $wEmplObj->resetPrevileges();
                        }
                }


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
                                $commObj = $this->het("workflow_commitee_id");
                                $wEmplObj = WorkflowEmployee::loadByMainIndex($commObj->getVal("orgunit_id"), $this->getVal("employee_id"));

                                if ($wEmplObj->id > 0) {
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
}
