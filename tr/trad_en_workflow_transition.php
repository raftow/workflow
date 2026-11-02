<?php

class WorkflowTransitionEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["workflow_transition"]["workflowtransition.single"] = "transition";
		$trad["workflow_transition"]["workflowtransition.new"] = "new";
		$trad["workflow_transition"]["workflow_transition"] = "transitions";
		$trad["workflow_transition"]["name_ar"] = "Arabic Workflow transition name";
		$trad["workflow_transition"]["name_en"] = "English Workflow transition name";
		$trad["workflow_transition"]["workflow_module_id"] = "Workflow module";
		$trad["workflow_transition"]["workflow_model_id"] = "Workflow model";
		$trad["workflow_transition"]["initial_stage_id"] = "Initial stage";
		$trad["workflow_transition"]["initial_status_id"] = "Start status";
		$trad["workflow_transition"]["workflow_action_id"] = "Workflow action";
		$trad["workflow_transition"]["workflow_role_mfk"] = "Required Roles";
		$trad["workflow_transition"]["workflow_condition_id"] = "condition";
		$trad["workflow_transition"]["notification_template_id"] = "Notification template";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new WorkflowTransitionArTranslator();
		return new WorkflowTransition();
	}
}