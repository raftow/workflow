<?php
class WorkflowRoleArTranslator{

    public static function initData()
    {
        $trad = [];

	$trad["workflow_role"]["workflowrole.single"] = "دور";
	$trad["workflow_role"]["workflowrole.new"] = "جديد";
	$trad["workflow_role"]["workflow_role"] = "أدوار";
	$trad["workflow_role"]["role_category_enum"] = "فئة الدور";
	$trad["workflow_role"]["role_name_ar"] = "اسم الدور - عربي";
	$trad["workflow_role"]["role_name_en"] = "اسم الدور - انجليزي";
	$trad["workflow_role"]["role_description_ar"] = "وصف الدور - عربي";
	$trad["workflow_role"]["role_description_en"] = "وصف الدور - انجليزي";
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new WorkflowRoleEnTranslator();
		return new WorkflowRole();
	}
}