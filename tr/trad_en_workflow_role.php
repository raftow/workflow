<?php
class WorkflowRoleEnTranslator
{

	public static function initData()
	{
		$trad = [];

		$trad["workflow_role"]["step1"] = "Definition";
        $trad["workflow_role"]["step2"] = "Properties";
        $trad["workflow_role"]["step3"] = "Job roles";

		$trad["workflow_role"]["jobrole_mfk"] = "Job roles";

		$trad["workflow_role"]["workflowrole.single"] = "Workflow role";
		$trad["workflow_role"]["workflowrole.new"] = "new";
		$trad["workflow_role"]["workflow_role"] = "Workflow roles";
		$trad["workflow_role"]["role_category_enum"] = "Role Category";
		$trad["workflow_role"]["role_name_ar"] = "role name - arabic";
		$trad["workflow_role"]["role_name_en"] = "role name - english";
		$trad["workflow_role"]["role_description_ar"] = "role description - arabic";
		$trad["workflow_role"]["role_description_en"] = "role descritopn - english";
		return $trad;
	}

	public static function getInstance()
	{
		if (false) return new WorkflowRoleArTranslator();
		return new WorkflowRole();
	}
}
