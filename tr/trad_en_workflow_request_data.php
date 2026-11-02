<?php
class WorkflowRequestDataEnTranslator{

    public static function initData()
    {
        $trad = [];

	$trad["workflow_request_data"]["workflowrequestdata.single"] = "Workflow request data";
	$trad["workflow_request_data"]["workflowrequestdata.new"] = "new";
	$trad["workflow_request_data"]["workflow_request_data"] = "Workflow request datas";
	$trad["workflow_request_data"]["workflow_request_id"] = "Workflow request";
	$trad["workflow_request_data"]["application_field_id"] = "Application field";
	$trad["workflow_request_data"]["field_value"] = "Field value";
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new WorkflowRequestDataArTranslator();
		return new WorkflowRequestData();
	}
}