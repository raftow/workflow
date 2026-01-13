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
                        list($orgunitObj, $wOrgunitObj) = $commObj->getOrgunitInfos();
                        $wEmplObj = WorkflowEmployee::loadByMainIndex($orgunitObj->id, $this->getVal("employee_id"), true);
                        $wEmplObj->set("hierarchy_level_enum", 999);
                        $wEmplObj->set("wrole_mfk", ",4,");
                        $wEmplObj->set("wscope_mfk", $wscope_mfk);
                        $wEmplObj->commit();
                        $wEmplObj->resetPrevileges();
                }


                return parent::afterInsert($id, $fields_updated, $disableAfterCommitDBEvent);
        }
}
