<?php
class WorkflowRequestArTranslator
{
	public static function initData()
	{
		$trad = [];

		$trad['workflow_request']['step1'] = 'تعريف الطلب';
		$trad['workflow_request']['step2'] = 'المعلومات';

		$trad['workflow_request']['step2'] = 'workflowRequestDataList';

		$trad['workflow_request']['workflowrequest.single'] = 'طلب قبول';
		$trad['workflow_request']['workflowrequest.new'] = 'جديد';
		$trad['workflow_request']['workflow_request'] = 'طلبات الاعتماد';
		$trad['workflow_request']['workflow_applicant_id'] = 'المتقدم';
		$trad['workflow_request']['workflow_model_id'] = 'النموذج';
		$trad['workflow_request']['workflow_scope_id'] = 'البرنامج';
		$trad['workflow_request']['workflow_stage_id'] = 'المرحلة';
		$trad['workflow_request']['workflow_status_id'] = 'حالة الطلب';
		$trad['workflow_request']['external_request_code'] = 'الرمز الخارجي للطلب';
		$trad['workflow_request']['request_type_code'] = 'رمز نوع الطلب';
		$trad['workflow_request']['workflow_session_id'] = 'دورة القبول';
		$trad['workflow_request']['request_date'] = 'تاريخ الطلب';
		$trad['workflow_request']['orgunit_id'] = 'الإدارة المكلفة';
		$trad['workflow_request']['employee_id'] = 'الموظف المكلف';
		$trad['workflow_request']['assign_date'] = 'تاريخ التكليف';
		$trad['workflow_request']['assign_time'] = 'وقت التكليف';
		$trad['workflow_request']['assignment'] = 'التكليف';
		$trad['workflow_request']['done'] = 'تم الانتهاء';
		$trad['workflow_request']['done_date'] = 'تاريخ الانتهاء';
		$trad['workflow_request']['done_time'] = 'وقت الانتهاء';

		$trad['workflow_request']['category'] = 'صنف العميل';

		return $trad;
	}

	public static function getInstance()
	{
		if (false)
			return new WorkflowRequestEnTranslator();
		return new WorkflowRequest();
	}
}
