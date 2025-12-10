<?php
class WorkflowStageEnTranslator{

    public static function initData()
    {
        $trad = [];
		$trad["workflow_stage"]["step1"] = "Definition";

		$trad["workflow_stage"]["workflowstage.single"] = "Workflow stage";
		$trad["workflow_stage"]["workflowstage.new"] = "new";
		$trad["workflow_stage"]["workflow_stage"] = "Workflow stages";
		$trad["workflow_stage"]["workflow_model_id"] = "Workflow model";
		$trad["workflow_stage"]["workflow_stage_name_ar"] = "Stage name - arabic";
		$trad["workflow_stage"]["workflow_stage_name_en"] = "Stage name - english";
		$trad["workflow_stage"]["workflow_stage_desc_ar"] = "Stage description - arabic";
		$trad["workflow_stage"]["workflow_stage_desc_en"] = "Stage description - english";
		$trad["workflow_stage"]["step_code"] = "Step code";
		$trad["workflow_stage"]["required_application_field_mfk"] = "Required application field";
		$trad["workflow_stage"]["standard_processing_time"] = "Standard Processing Time";
		$trad["workflow_stage"]["time_unit"] = "Time unit";
		$trad["workflow_stage"]["processing_request_responsibility"] = "Responsibility for processing the request";
		$trad["workflow_stage"]["workflow_role_id"] = "Roles assigned";
		$trad["workflow_stage"]["interview_ind"] = "Includes a personal interview";
        return $trad;
    }

    public static function getInstance()
	{
                if(false) return new WorkflowStageArTranslator();
		return new WorkflowStage();
	}
}