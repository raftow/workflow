<?php
class WorkflowRole extends WorkflowObject
{

        public static $DATABASE                = "";
        public static $MODULE                    = "workflow";
        public static $TABLE                        = "workflow_role";
        private static $roleIsForAssignArr = [];
        public static $DB_STRUCTURE = null;
        // public static $copypast = true;

        public function __construct()
        {
                parent::__construct("workflow_role", "id", "workflow");
                WorkflowWorkflowRoleAfwStructure::initInstance($this);
        }

        public static function loadById($id)
        {
                $obj = new WorkflowRole();

                if ($obj->load($id)) {
                        return $obj;
                } else return null;
        }

        /**
         * @param int $id
         */
        public static function roleIsForAssign($id)
        {
                if (!isset($roleIsForAssignArr[$id])) {
                        $obj = new WorkflowTransition();
                        $obj->select("active", "Y");
                        $obj->mfkContain("workflow_role_mfk", $id);
                        $roleIsForAssignArr[$id] = ($obj->count() > 0);
                }

                return $roleIsForAssignArr[$id];
        }

        public function getDisplay($lang = 'ar')
        {
                return $this->getDefaultDisplay($lang);
        }

        public function stepsAreOrdered()
        {
                return false;
        }

        public function shouldBeCalculatedField($attribute)
        {
                if ($attribute == "domain1_enum") return true;
                if ($attribute == "domain2_enum") return true;
                if ($attribute == "domain3_enum") return true;
                if ($attribute == "domain4_enum") return true;
                return false;
        }

        public function afterMaj($id, $fields_updated)
        {
                if ($fields_updated["jobrole_mfk"]) {
                        UfwQueryAnalyzer::startProcessLourdMode();
                        $arr_roles = [$this->id];
                        $wEmplList = WorkflowEmployee::getEmployeeList($orgunit_id = 0, $wscope_id = 0, $except_employee_id = 0, $arr_roles, $hrm = false);

                        $count = 0;
                        $counterr = 0;
                        foreach ($wEmplList as $wEmplItem) {
                                /**
                                 * @var WorkflowEmployee $wEmplItem
                                 */
                                list($err,) = $wEmplItem->resetPrevileges();
                                if ($err) $counterr++;
                                else $count++;
                        }
                        AfwSession::console("afterMaj of jobrole_mfk of workflow role [employees previlege resetted : $count | errors : $counterr]", "information");
                        UfwQueryAnalyzer::stopProcessLourdMode();
                }
        }
}
