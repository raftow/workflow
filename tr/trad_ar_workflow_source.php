<?php
class WorkflowSourceArTranslator
{

	public static function initData()
	{
		$trad = [];

		$trad["workflow_source"]["workflowsource.single"] = "مصدر";
		$trad["workflow_source"]["workflowsource.new"] = "جديد	";
		$trad["workflow_source"]["workflow_source"] = "المصادر";
		$trad["workflow_source"]["source_name_ar"] = "اسم المصدر - عربي";
		$trad["workflow_source"]["source_name_en"] = "اسم المصدر - انجليزي";
		$trad["workflow_source"]["source_description_ar"] = "وصف المصدر - عربي";
		$trad["workflow_source"]["source_description_en"] = "وصف المصدر - انجليزي";
		$trad["workflow_source"]["workflow_module_id"] = "وحدة العمل";
		return $trad;
	}

	public static function getInstance()
	{
		if (false) return new WorkflowSourceEnTranslator();
		return new WorkflowSource();
	}
}
