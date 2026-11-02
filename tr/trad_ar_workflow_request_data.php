<?php
class WorkflowRequestDataArTranslator{

    public static function initData()
    {
        $trad = [];

	$trad["workflow_request_data"]["workflowrequestdata.single"] = "بيانات طلب";
	$trad["workflow_request_data"]["workflowrequestdata.new"] = "جديدة";
	$trad["workflow_request_data"]["workflow_request_data"] = "بيانات طلبات";
	$trad["workflow_request_data"]["workflow_request_id"] = "الطلب";
	$trad["workflow_request_data"]["application_field_id"] = "الحقل المطلوب";
	$trad["workflow_request_data"]["field_value"] = "قيمة الحقل";
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new WorkflowRequestDataEnTranslator();
		return new WorkflowRequestData();
	}
}