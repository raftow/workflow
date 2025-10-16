<?php
class WorkflowCommiteeScopeArTranslator{

    public static function initData()
    {
        $trad = [];

	$trad["workflow_commitee_scope"]["workflowcommiteescope.single"] = "مجال لجنة";
	$trad["workflow_commitee_scope"]["workflowcommiteescope.new"] = "جديد";
	$trad["workflow_commitee_scope"]["workflow_commitee_scope"] = "مجالات اللجان";
	$trad["workflow_commitee_scope"]["workflow_commitee_id"] = "اللجنة";
	$trad["workflow_commitee_scope"]["workflow_scope_id"] = "البرنامج";
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new WorkflowCommiteeScopeEnTranslator();
		return new WorkflowCommiteeScope();
	}
}