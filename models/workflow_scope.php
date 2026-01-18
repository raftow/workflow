<?php

class WorkflowScope extends WorkflowObject
{

    public static $DATABASE = '';

    public static $MODULE = 'workflow';

    public static $TABLE = 'workflow_scope';

    public static $DB_STRUCTURE = null;
    // public static $copypast = true;

    public function __construct()
    {
        parent::__construct('workflow_scope', 'id', 'workflow');
        WorkflowWorkflowScopeAfwStructure::initInstance($this);
    }

    public static function loadById($id)
    {
        $obj = new WorkflowScope();

        if ($obj->load($id)) {
            return $obj;
        } else {
            return null;
        }
    }

    public static function loadByMainIndex($workflow_module_id, $lookup_code, $create_obj_if_not_found = false)
    {
        if (! $workflow_module_id) {
            throw new AfwRuntimeException('loadByMainIndex : workflow_module_id is mandatory field');
        }

        if (! $lookup_code) {
            throw new AfwRuntimeException('loadByMainIndex : lookup_code is mandatory field');
        }

        $obj = new WorkflowScope();
        $obj->select('workflow_module_id', $workflow_module_id);
        $obj->select('lookup_code', $lookup_code);

        if ($obj->load()) {
            if ($create_obj_if_not_found) {
                $obj->activate();
            }

            return $obj;
        } elseif ($create_obj_if_not_found) {
            $obj->set('workflow_module_id', $workflow_module_id);
            $obj->set('lookup_code', $lookup_code);

            $obj->insertNew();
            if (! $obj->id) {
                return null;
            }

            // means beforeInsert rejected insert operation
            $obj->is_new = true;
            return $obj;
        } else {
            return null;
        }
    }

    public function getDisplay($lang = 'ar')
    {
        return $this->getDefaultDisplay($lang);
    }

    public function stepsAreOrdered()
    {
        return false;
    }


    public function select_visibilite_horizontale($dropdown = false)
    {
        $objme = AfwSession::getUserConnected();

        if ($objme and $objme->isAdmin()) {
            // no VH for system admin
        }
        /* Amjad whatsapp 18/01/2026 7pm ~ audio say do not limit for users for the moment
        else {
            $employee_id = $objme ? $objme->getEmployeeId() : 0;

            if ($employee_id) {
                $wEmplObj = WorkflowEmployee::findWorkflowEmployee($employee_id);
                if ($wEmplObj) {
                    $wscope_mfk = trim($wEmplObj->getVal("wscope_mfk"), ",");
                    $this->where("id in ($wscope_mfk)");
                }
            }
        }*/

        $selects = array();
        $this->select_visibilite_horizontale_default($dropdown, $selects);
    }
}
