<?php
class WorkflowRequestArTranslator
{

	public static function initData()
	{
		$trad = [];

		$trad["workflow_request"]["step1"] = "تعريف الطلب";
		$trad["workflow_request"]["step2"] = "المعلومات";

		$trad["workflow_request"]["step2"] = "workflowRequestDataList";

		$trad["workflow_request"]["workflowrequest.single"] = "طلب اعتماد";
		$trad["workflow_request"]["workflowrequest.new"] = "جديد";
		$trad["workflow_request"]["workflow_request"] = "طلبات الاعتماد";
		$trad["workflow_request"]["workflow_applicant_id"] = "المتقدم";
		$trad["workflow_request"]["workflow_model_id"] = "نموذج سير العمل";
		$trad["workflow_request"]["workflow_stage_id"] = "المرحلة";
		$trad["workflow_request"]["workflow_status_id"] = "حالة الطلب";
		$trad["workflow_request"]["external_request_code"] = "الرمز الخارجي للطلب";
		$trad["workflow_request"]["request_type_code"] = "رمز نوع الطلب";
		return $trad;
	}

	public static function getInstance()
	{
		if (false) return new WorkflowRequestEnTranslator();
		return new WorkflowRequest();
	}
}
