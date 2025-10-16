<?php
class WorkflowScopeEnTranslator{

    public static function initData()
    {
        $trad = [];

	$trad["workflow_scope"]["workflowscope.single"] = "Workflow scope";
	$trad["workflow_scope"]["workflowscope.new"] = "new";
	$trad["workflow_scope"]["workflow_scope"] = "Workflow scopes";
	$trad["workflow_scope"]["scope_name_ar"] = "scope name - arabic";
	$trad["workflow_scope"]["scope_name_en"] = "Scope name - english";
	$trad["workflow_scope"]["scope_description_ar"] = "Scope description - arabic";
	$trad["workflow_scope"]["scope_description_en"] = "Scope name - english";
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new WorkflowScopeArTranslator();
		return new WorkflowScope();
	}
}