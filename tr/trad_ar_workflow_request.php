<?php
class WorkflowRequestArTranslator
{
	public static function initData()
	{
		$trad = [];

		$trad['workflow_request']['step1'] = 'البيانات الشخصية';
		$trad['workflow_request']['step2'] = 'طلب التقديم';
		$trad['workflow_request']['step3'] = 'المؤهلات';
		$trad['workflow_request']['step4'] = 'الاختبارات';
		$trad['workflow_request']['step5'] = 'مراجعة الوثائق';
		$trad['workflow_request']['step6'] = 'مراجعة اللجنة';
		$trad['workflow_request']['step7'] = 'المقابلة الشخصية';
		$trad['workflow_request']['step8'] = 'المفاضلة والقبول';
		// $trad['workflow_request']['step9'] = 'حالة الطلب';

		$trad['workflow_request']['formComments'] = 'الملاحظات';
		$trad['workflow_request']['request'] = 'حيثيات الطلب';
		$trad["workflow_request"]["workflow_rejection_reason_id"] = "سبب الرفض";
		$trad["workflow_request"]["rejection_reason"] = "بيان سبب الرفض في حالة الرفض";

		$trad['workflow_request']['workflowRequestDataList'] = 'بيانات الطلب';

		$trad['workflow_request']['workflowrequest.single'] = 'طلب قبول';
		$trad['workflow_request']['workflowrequest.new'] = 'جديد';
		$trad['workflow_request']['workflow_request'] = 'طلبات القبول';
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
		$trad['workflow_request']['done'] = 'تم الانتهاء؟';
		$trad['workflow_request']['done.YES'] = 'تم الانتهاء';
		$trad['workflow_request']['done.NO'] = 'لم يبدأ العمل';
		$trad['workflow_request']['done.EUH'] = 'جاري العمل';

		$trad['workflow_request']['done_date'] = 'تاريخ الانتهاء';
		$trad['workflow_request']['done_time'] = 'وقت الانتهاء';

		$trad['workflow_request']['profile'] = 'البيانات الشخصية';
		$trad['workflow_request']['category'] = 'صنف العميل';
		$trad['workflow_request']['mobile'] = 'رقم الجوال';
		$trad['workflow_request']['gender_enum'] = 'الجنس';
		$trad['workflow_request']['country_id'] = 'الجنسية';
		$trad['workflow_request']['passeport_num'] = 'جواز السفر';

		return $trad;
	}

	public static function getInstance()
	{
		if (false)
			return new WorkflowRequestEnTranslator();
		return new WorkflowRequest();
	}
}
