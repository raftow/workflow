<?php
class WorkflowRole extends WorkflowObject
{

        public static $DATABASE                = "";
        public static $MODULE                    = "workflow";
        public static $TABLE                        = "workflow_role";
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
                        $arr_roles = [$this->id];
                        $wEmplList = WorkflowEmployee::getEmployeeList($orgunit_id = 0, $wscope_id = 0, $except_employee_id = 0, $arr_roles, $hrm = false);
                        /**
                         * @var WorkflowEmployee $wEmplItem
                         */
                        foreach ($wEmplList as $wEmplItem) {
                                $wEmplItem->resetPrevileges();
                        }
                }
        }
}
