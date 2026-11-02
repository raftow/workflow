<?php

class WorkflowSessionEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["workflow_session"]["workflowsession.single"] = "Workflow session";
		$trad["workflow_session"]["workflowsession.new"] = "new";
		$trad["workflow_session"]["workflow_session"] = "Workflow session";
		$trad["workflow_session"]["name_ar"] = "Arabic Workflow session name";
		$trad["workflow_session"]["name_en"] = "English Workflow session name";
		$trad["workflow_session"]["desc_ar"] = "Arabic Workflow session description";
		$trad["workflow_session"]["desc_en"] = "English Workflow session description";
		$trad["workflow_session"]["workflow_module_id"] = "Workflow module";
		$trad["workflow_session"]["external_code"] = "External code";
		$trad["workflow_session"]["session_code"] = "Session code";
		$trad["workflow_session"]["workflow_session_name_ar"] = "text.100";
		$trad["workflow_session"]["workflow_session_name_en"] = "text.100";
		$trad["workflow_session"]["workflow_session_desc_ar"] = "text.AREA";
		$trad["workflow_session"]["workflow_session_desc_en"] = "text.AREA";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new WorkflowSessionArTranslator();
		return new WorkflowSession();
	}
}