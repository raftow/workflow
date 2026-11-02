<?php
class WorkflowModuleEnTranslator
{

	public static function initData()
	{
		$trad = [];
		$trad["workflow_module"]["step1"] = "Definition";
		$trad["workflow_module"]["step2"] = "Conditions";
		$trad["workflow_module"]["step3"] = "Domains";

		$trad["workflow_module"]["workflowmodule.single"] = "Workflow module";
		$trad["workflow_module"]["workflowmodule.new"] = "new";
		$trad["workflow_module"]["workflow_module"] = "Workflow modules";
		$trad["workflow_module"]["module_name_ar"] = "Module name -   Ar";
		$trad["workflow_module"]["module_name_en"] = "Module name -   en";
		$trad["workflow_module"]["module_description_ar"] = "Module Description - ar";
		$trad["workflow_module"]["module_description_en"] = "Module Description - en";
		$trad["workflow_module"]["lookup_code"] = "lookup code";
		return $trad;
	}

	public static function getInstance()
	{
		if (false) return new WorkflowModuleArTranslator();
		return new WorkflowModule();
	}
}
