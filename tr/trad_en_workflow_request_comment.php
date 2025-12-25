<?php

class WorkflowRequestCommentEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["workflow_request_comment"]["workflowrequestcomment.single"] = "Workflow session";
		$trad["workflow_request_comment"]["workflowrequestcomment.new"] = "new";
		$trad["workflow_request_comment"]["workflow_request_comment"] = "Workflow session";
		$trad["workflow_request_comment"]["name_ar"] = "Arabic Workflow request comment name";
		$trad["workflow_request_comment"]["name_en"] = "English Workflow request comment name";
		$trad["workflow_request_comment"]["desc_ar"] = "Arabic Workflow request comment description";
		$trad["workflow_request_comment"]["desc_en"] = "English Workflow request comment description";
		$trad["workflow_request_comment"]["Comment"] = "text.AREA";
		$trad["workflow_request_comment"]["request_comment_subject_id"] = "Request comment subject";
		$trad["workflow_request_comment"]["Workflow_stage_id"] = "Workflow stage";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new WorkflowRequestCommentArTranslator();
		return new WorkflowRequestComment();
	}
}