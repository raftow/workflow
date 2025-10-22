<?php
class WorkflowRejectionReasonEnTranslator{

    public static function initData()
    {
        $trad = [];

	$trad["workflow_rejection_reason"]["workflowrejectionreason.single"] = "Workflow rejection reason";
	$trad["workflow_rejection_reason"]["workflowrejectionreason.new"] = "new";
	$trad["workflow_rejection_reason"]["workflow_rejection_reason"] = "Workflow rejection reasons";
	$trad["workflow_rejection_reason"]["rejection_reason_ar"] = "Rejection Reason name -   Ar";
	$trad["workflow_rejection_reason"]["rejection_reason_en"] = "Rejection Reason name -   en";
	$trad["workflow_rejection_reason"]["workflow_stage_id"] = "Stage linked to";
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new WorkflowRejectionReasonArTranslator();
		return new WorkflowRejectionReason();
	}
}