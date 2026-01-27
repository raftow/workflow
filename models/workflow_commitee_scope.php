<?php
class WorkflowCommiteeScope extends WorkflowObject
{

        public static $DATABASE                = "";
        public static $MODULE                    = "workflow";
        public static $TABLE                        = "workflow_commitee_scope";
        public static $DB_STRUCTURE = null;
        // public static $copypast = true;

        public function __construct()
        {
                parent::__construct("workflow_commitee_scope", "id", "workflow");
                WorkflowWorkflowCommiteeScopeAfwStructure::initInstance($this);
        }

        public static function loadById($id)
        {
                $obj = new WorkflowCommiteeScope();

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

        public function beforeMaj($id, $fields_updated)
        {
                if ($fields_updated["workflow_commitee_id"]) return false; // denied to change the committee it cause problem of roles 
                // not updated, but remove this record and insert another instead of update ...
        }

        public function afterMaj($id, $fields_updated)
        {
                if ($fields_updated["workflow_scope_id"]) // should be impossible because the field is R/O but ....
                {
                        $this->refreshCommiteeSecretaryRoles();
                }
        }

        public function afterDelete($id, $id_replace)
        {
                $this->refreshCommiteeSecretaryRoles();
        }

        public function refreshCommiteeSecretaryRoles()
        {
                $commObj = $this->het("workflow_commitee_id");
                if ($commObj) {
                        /**
                         * @var WorkflowCommiteeMember $secretaryMemberObj
                         */
                        $secretaryMemberObj = $commObj->mySecretaryMember();
                        if ($secretaryMemberObj) $secretaryMemberObj->refreshMyRoles();
                }
        }
}
