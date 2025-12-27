<?php

class WorkflowModuleArTranslator
{
	public static function initData()
	{
		$trad = [];
		$trad['workflow_module']['step1'] = 'التعريف';
		$trad['workflow_module']['step2'] = 'الشروط';
		$trad['workflow_module']['step3'] = 'القطاعات';

		$trad['workflow_module']['workflowConditionList'] = 'الشروط';

		$trad['workflow_module']['workflowmodule.single'] = 'تطبيق';
		$trad['workflow_module']['workflowmodule.new'] = 'جديد';
		$trad['workflow_module']['workflow_module'] = 'تطبيقات';
		$trad['workflow_module']['module_name_ar'] = 'اسم التطبيق - عربي';
		$trad['workflow_module']['module_name_en'] = 'اسم التطبيق - انجليزي';
		$trad['workflow_module']['module_description_ar'] = 'وصف التطبيق - عربي';
		$trad['workflow_module']['module_description_en'] = 'وصف التطبيق - انجليزي';
		$trad['workflow_module']['lookup_code'] = 'رمز التطبيق';
		$trad['workflow_module']['domain1_enum'] = 'القطاع الأساسي';
		$trad['workflow_module']['domain2_enum'] = 'القطاع المساند';
		$trad['workflow_module']['domain3_enum'] = 'القطاع المساند 2';
		$trad['workflow_module']['domain4_enum'] = 'القطاع المساند 3';

		return $trad;
	}

	public static function getInstance()
	{
		if (false)
			return new WorkflowModuleEnTranslator();
		return new WorkflowModule();
	}
}
