<?php
class WorkflowRequest extends WorkflowObject
{

        public static $DATABASE                = "";
        public static $MODULE                    = "workflow";
        public static $TABLE                        = "workflow_request";
        public static $DB_STRUCTURE = null;
        // public static $copypast = true;

        public function __construct()
        {
                parent::__construct("workflow_request", "id", "workflow");
                WorkflowWorkflowRequestAfwStructure::initInstance($this);
        }

        public static function loadById($id)
        {
                $obj = new WorkflowRequest();

                if ($obj->load($id)) {
                        return $obj;
                } else return null;
        }


        public static function loadByMainIndex($workflow_applicant_id, $workflow_model_id, $create_obj_if_not_found = false)
        {
                if (!$workflow_applicant_id) throw new AfwRuntimeException("loadByMainIndex : workflow_applicant_id is mandatory field");
                if (!$workflow_model_id) throw new AfwRuntimeException("loadByMainIndex : workflow_model_id is mandatory field");


                $obj = new WorkflowRequest();
                $obj->select("workflow_applicant_id", $workflow_applicant_id);
                $obj->select("workflow_model_id", $workflow_model_id);

                if ($obj->load()) {
                        if ($create_obj_if_not_found) $obj->activate();
                        return $obj;
                } elseif ($create_obj_if_not_found) {
                        $obj->set("workflow_applicant_id", $workflow_applicant_id);
                        $obj->set("workflow_model_id", $workflow_model_id);

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

        public static function inboxSqlCond($role, $employee_id, $prefix = "me.")
        {
                if ($role == "supervisor")   return $prefix."supervisor_id='$employee_id' and ".$prefix."status_id in (0,0) -- REQUEST_STATUSES_ONGOING_SUPERVISOR";
                if ($role == "investigator") return $prefix."employee_id='$employee_id' and ".$prefix."status_id in (0,0,0) -- REQUEST_STATUSES_ONGOING_INVESTIGATOR";

                return "1=2";
        }
}
