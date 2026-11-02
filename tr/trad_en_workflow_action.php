<?php
class WorkflowActionEnTranslator{

    public static function initData()
    {
        $trad = [];
	$trad["workflow_action"]["step1"] = "Definition";

	$trad["workflow_action"]["workflowaction.single"] = "Workflow action";
	$trad["workflow_action"]["workflowaction.new"] = "new";
	$trad["workflow_action"]["workflow_action"] = "Workflow actions";
	$trad["workflow_action"]["workflow_model_id"] = "Workflow model";
	$trad["workflow_action"]["workflow_action_name_ar"] = "Action name - arabic";
	$trad["workflow_action"]["workflow_action_name_en"] = "Action name - english";
	$trad["workflow_action"]["action_type_enum"] = "Action type";
	$trad["workflow_action"]["workflow_action_desc_ar"] = "Action description - arabic";
	$trad["workflow_action"]["workflow_action_desc_en"] = "Action description - english";
	$trad["workflow_action"]["comments_mandatory"] = "Comments mandatory";
	$trad["workflow_action"]["workflow_stage_id"] = "Stage linked to";
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new WorkflowActionArTranslator();
		return new WorkflowAction();
	}
}