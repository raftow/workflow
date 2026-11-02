<?php
class WorkflowRequestEnTranslator
{

	public static function initData()
	{
		$trad = [];

		$trad["workflow_request"]["workflowrequest.single"] = "Workflow request";
		$trad["workflow_request"]["workflowrequest.new"] = "new";
		$trad["workflow_request"]["workflow_request"] = "Workflow requests";
		$trad["workflow_request"]["workflow_applicant_id"] = "applicant";
		$trad["workflow_request"]["workflow_model_id"] = "Workflow model";
		$trad["workflow_request"]["workflow_stage_id"] = "Workflow stage";
		$trad["workflow_request"]["workflow_status_id"] = "Workflow status";
		$trad["workflow_request"]["external_request_code"] = "External request code";
		$trad["workflow_request"]["request_type_code"] = "Request type code";
		$trad["workflow_request"]["workflow_rejection_reason_id"] = "Workflow rejection reason";
		return $trad;
	}

	public static function getInstance()
	{
		if (false) return new WorkflowRequestArTranslator();
		return new WorkflowRequest();
	}
}
