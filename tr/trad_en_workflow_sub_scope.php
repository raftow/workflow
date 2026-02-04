<?php

class WorkflowSubScopeEnTranslator
{
    public static function initData()
    {
        $trad = [];

        $trad["workflow_sub_scope"]["workflowsubscope.single"] = "Branch";
        $trad["workflow_sub_scope"]["workflowsubscope.new"] = "new";
        $trad["workflow_sub_scope"]["workflow_sub_scope"] = "Branchs";
        $trad["workflow_sub_scope"]["sub_scope_name_ar"] = "Branch Name - Arabic";
        $trad["workflow_sub_scope"]["sub_scope_name_en"] = "Branch Name - English";
        $trad["workflow_sub_scope"]["sub_scope_description_ar"] = "Branch Description - Arabic";
        $trad["workflow_sub_scope"]["sub_scope_description_en"] = "Branch Description - English";
        $trad["workflow_sub_scope"]["workflow_module_id"] = "Workflow Module";
        $trad["workflow_sub_scope"]["workflow_scope_id"] = "Workflow Scope";
        // steps
        return $trad;
    }

    public static function getInstance()
    {
        if (false) return new WorkflowSubScopeArTranslator();
        return new WorkflowSubScope();
    }
}
