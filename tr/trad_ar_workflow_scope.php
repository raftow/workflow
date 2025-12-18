<?php
class WorkflowScopeArTranslator
{

	public static function initData()
	{
		$trad = [];

		$trad["workflow_scope"]["workflowscope.single"] = "برنامج";
		$trad["workflow_scope"]["workflowscope.new"] = "جديد	";
		$trad["workflow_scope"]["workflow_scope"] = "البرامج";
		$trad["workflow_scope"]["scope_name_ar"] = "اسم البرنامج - عربي";
		$trad["workflow_scope"]["scope_name_en"] = "اسم البرنامج - انجليزي";
		$trad["workflow_scope"]["scope_description_ar"] = "وصف البرنامج - عربي";
		$trad["workflow_scope"]["scope_description_en"] = "وصف البرنامج - انجليزي";
		$trad["workflow_scope"]["workflow_module_id"] = "وحدة العمل";
		return $trad;
	}

	public static function getInstance()
	{
		if (false) return new WorkflowScopeEnTranslator();
		return new WorkflowScope();
	}
}
