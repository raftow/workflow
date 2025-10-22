<?php
class WorkflowStatusEnTranslator{

    public static function initData()
    {
        $trad = [];
	$trad["workflow_status"]["step1"] = "Definition";

	$trad["workflow_status"]["workflowstatus.single"] = "Workflow status";
	$trad["workflow_status"]["workflowstatus.new"] = "new";
	$trad["workflow_status"]["workflow_status"] = "Workflow statuss";
	$trad["workflow_status"]["workflow_model_id"] = "Workflow model";
	$trad["workflow_status"]["workflow_status_name_ar"] = "Status name - arabic";
	$trad["workflow_status"]["workflow_status_name_en"] = "Status name - english";
	$trad["workflow_status"]["workflow_status_desc_ar"] = "Status description - arabic";
	$trad["workflow_status"]["workflow_status_desc_en"] = "Status description - english";
	$trad["workflow_status"]["status_code"] = "Status code";
	$trad["workflow_status"]["workflow_stage_id"] = "Stage linked to";
	$trad["workflow_status"]["interview_invite_ind"] = "Interview invitation? (y/n)";
	$trad["workflow_status"]["is_final"] = "Is final Status? (y/n)";
	$trad["workflow_status"]["payment_ind"] = "Payment Status? (y/n)";
	$trad["workflow_status"]["web_ind"] = "Is the status visible to the applicant?   (y/n)";
	$trad["workflow_status"]["applicant_can_cancel"] = "Can the applicant cancel?"; 
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new WorkflowStatusArTranslator();
		return new WorkflowStatus();
	}
}