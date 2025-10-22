<?php
class WorkflowRejectionReasonArTranslator{

    public static function initData()
    {
        $trad = [];

	$trad["workflow_rejection_reason"]["workflowrejectionreason.single"] = "سبب رفض";
	$trad["workflow_rejection_reason"]["workflowrejectionreason.new"] = "جديد";
	$trad["workflow_rejection_reason"]["workflow_rejection_reason"] = "أسباب الرفض";
	$trad["workflow_rejection_reason"]["rejection_reason_ar"] = "سبب الرفض - عربي";
	$trad["workflow_rejection_reason"]["rejection_reason_en"] = "سبب الرفض - انجليزي";
	$trad["workflow_rejection_reason"]["workflow_stage_id"] = "المرحلة المرتبطة";
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new WorkflowRejectionReasonEnTranslator();
		return new WorkflowRejectionReason();
	}
}