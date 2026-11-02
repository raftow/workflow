<?php
class WorkflowModule extends WorkflowObject
{

        public static $DATABASE                = "";
        public static $MODULE                    = "workflow";
        public static $TABLE                        = "workflow_module";
        public static $DB_STRUCTURE = null;
        // public static $copypast = true;

        public function __construct()
        {
                parent::__construct("workflow_module", "id", "workflow");
                WorkflowWorkflowModuleAfwStructure::initInstance($this);
        }

        public static function loadById($id)
        {
                $obj = new WorkflowModule();

                if ($obj->load($id)) {
                        return $obj;
                } else return null;
        }

        public static function loadAll()
        {
                $obj = new WorkflowModule();
                $obj->select("active", 'Y');

                $objList = $obj->loadMany();

                return $objList;
        }


        public function getScenarioItemId($currstep)
        {
                if ($currstep == 1) return 549;
                if ($currstep == 2) return 586;
                if ($currstep == 3) return 660;

                return 0;
        }

        public static function loadByMainIndex($lookup_code, $create_obj_if_not_found = false)
        {
                if (!$lookup_code) throw new AfwRuntimeException("loadByMainIndex : lookup_code is mandatory field");


                $obj = new WorkflowModule();
                $obj->select("lookup_code", $lookup_code);

                if ($obj->load()) {
                        if ($create_obj_if_not_found) $obj->activate();
                        return $obj;
                } elseif ($create_obj_if_not_found) {
                        $obj->set("lookup_code", $lookup_code);

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

        /**
         * @param string $workflow_module
         */

        public static function get_workflow_module_id($workflow_module)
        {

                $obj = WorkflowModule::loadByMainIndex(strtoupper($workflow_module));

                if ($obj) {
                        return $obj->id;
                } else {
                        return null;
                }
        }
}
