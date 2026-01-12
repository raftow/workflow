<?php

class WorkflowOrgunitArTranslator
{
	public static function initData()
	{
		$trad = [];
		$trad['workflow_orgunit']['workfloworgunit.single'] = 'إدارة قبول';
		$trad['workflow_orgunit']['workfloworgunit.new'] = 'جديد(ة)';
		$trad['workflow_orgunit']['workflow_orgunit'] = 'إدارات القبول';
		$trad['workflow_orgunit']['orgunit_id'] = 'الإدارة';
		$trad['workflow_orgunit']['requests_nb'] = 'طاقة استيعاب الطلبات يوميا لكل موظف قبول';
		$trad['workflow_orgunit']['requests_count'] = 'مجموع عدد الطلبات الجارية';
		$trad['workflow_orgunit']['requests_count.tooltip'] = 'ءءءءءءءءءءءءءءءءءءءءءءء';
		$trad['workflow_orgunit']['new_requests_count'] = 'مجموع عدد الطلبات الجديدة';
		$trad['workflow_orgunit']['new_requests_count.tooltip'] = 'ثثثثثثثثثثثثثثثثثثثثثثثثث';
		$trad['workflow_orgunit']['allEmployeeList'] = 'موظفي القبول';
		$trad['workflow_orgunit']['unAssignedRequests'] = 'طلبات يجب العمل عليها واسنادها';
		$trad['workflow_orgunit']['currentRequests'] = 'الطلبات الجارية';

		$trad['workflow_orgunit']['step1'] = 'البيانات العامة';
		$trad['workflow_orgunit']['step2'] = 'الموظفون';
		$trad['workflow_orgunit']['step3'] = 'الطلبات المسندة';
		// $trad['workflow_orgunit']['step4'] = 'تعي ين الموظفين';
		$trad['workflow_orgunit']['step5'] = 'إعدادات الاحصائيات';

		// $trad['workflow_orgunit']['tempEmployeeList'] = 'طلبات تعي ين موظف';

		$trad['workflow_orgunit']['perf_stats_days'] = 'عدد أيام تقرير الأداء';
		$trad['workflow_orgunit']['standard_stats_days'] = 'عدد أيام تقارير الاحصائيات';
		// $trad["workflow_orgunit"]["satisfaction_stats_days"] = "عدد أيام تقرير رضا العملاء";
		// $trad["workflow_orgunit"]["late_days"] = "عدد الأيام الأقصى للرد على العميل";
		// $trad["workflow_orgunit"]["late_days.tooltip"] = "بعدها يحسب الطلب متأخرا في التقارير";

		return $trad;
	}

	public static function getInstance()
	{
		return new WorkflowOrgunit();
	}
}
