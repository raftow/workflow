<?php
class WorkflowCommiteeScopeEnTranslator{

    public static function initData()
    {
        $trad = [];

	$trad["workflow_commitee_scope"]["workflowcommiteescope.single"] = "Workflow commitee scope";
	$trad["workflow_commitee_scope"]["workflowcommiteescope.new"] = "new";
	$trad["workflow_commitee_scope"]["workflow_commitee_scope"] = "Workflow commitee scopes";
	$trad["workflow_commitee_scope"]["workflow_commitee_id"] = "Commitee";
	$trad["workflow_commitee_scope"]["workflow_scope_id"] = "Scope";
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new WorkflowCommiteeScopeArTranslator();
		return new WorkflowCommiteeScope();
	}
}