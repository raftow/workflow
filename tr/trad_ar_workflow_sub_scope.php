<?php
class WorkflowSubScopeArTranslator
{

	public static function initData()
	{
		$trad = [];

		$trad["workflow_sub_scope"]["workflowsubscope.single"] = "فرع";
		$trad["workflow_sub_scope"]["workflowsubscope.new"] = "جديد	";
		$trad["workflow_sub_scope"]["workflow_sub_scope"] = "الفروع";
		$trad["workflow_sub_scope"]["sub_scope_name_ar"] = "اسم الفرع - عربي";
		$trad["workflow_sub_scope"]["sub_scope_name_en"] = "اسم الفرع - انجليزي";
		$trad["workflow_sub_scope"]["sub_scope_description_ar"] = "وصف الفرع - عربي";
		$trad["workflow_sub_scope"]["sub_scope_description_en"] = "وصف الفرع - انجليزي";
		$trad["workflow_sub_scope"]["workflow_module_id"] = "وحدة العمل";
		$trad["workflow_sub_scope"]["workflow_scope_id"] = "البرنامج";
		return $trad;
	}

	public static function getInstance()
	{
		if (false) return new WorkflowSubScopeEnTranslator();
		return new WorkflowSubScope();
	}
}
