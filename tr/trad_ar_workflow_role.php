<?php
class WorkflowRoleArTranslator
{
	public static function initData()
	{
		$trad = [];

		$trad['workflow_role']['step1'] = 'التعريف';
		$trad['workflow_role']['step2'] = 'الخصائص';
		$trad['workflow_role']['step3'] = 'الأدوار الوظيفية';

		$trad['workflow_role']['jobrole_mfk'] = 'الأدوار الوظيفية';

		$trad['workflow_role']['workflowrole.single'] = 'صلاحية';
		$trad['workflow_role']['workflowrole.new'] = 'جديدة';
		$trad['workflow_role']['workflow_role'] = 'الصلاحيات';
		$trad['workflow_role']['workflow_role'] = 'رمز الصلاحية';
		$trad['workflow_role']['role_category_enum'] = 'فئة الصلاحية';
		$trad['workflow_role']['role_name_ar'] = 'اسم الصلاحية - عربي';
		$trad['workflow_role']['role_name_en'] = 'اسم الصلاحية - انجليزي';
		$trad['workflow_role']['role_description_ar'] = 'وصف الصلاحية - عربي';
		$trad['workflow_role']['role_description_en'] = 'وصف الصلاحية - انجليزي';
		$trad['workflow_role']['workflow_module_id'] = 'التطبيق';

		return $trad;
	}

	public static function getInstance()
	{
		if (false)
			return new WorkflowRoleEnTranslator();
		return new WorkflowRole();
	}
}
