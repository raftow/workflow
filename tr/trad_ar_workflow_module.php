<?php 


class WorkflowModuleArTranslator{

    public static function initData()
    {
        $trad = [];
	$trad["workflow_module"]["step1"] = "التعريف";

	$trad["workflow_module"]["workflowmodule.single"] = "تطبيق";
	$trad["workflow_module"]["workflowmodule.new"] = "جديد";
	$trad["workflow_module"]["workflow_module"] = "تطبيقات";
	$trad["workflow_module"]["module_name_ar"] = "اسم التطبيق - عربي";
	$trad["workflow_module"]["module_name_en"] = "اسم التطبيق - انجليزي";
	$trad["workflow_module"]["module_description_ar"] = "وصف التطبيق - عربي";
	$trad["workflow_module"]["module_description_en"] = "وصف التطبيق - انجليزي";
	$trad["workflow_module"]["lookup_code"] = "";
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new WorkflowModuleEnTranslator();
		return new WorkflowModule();
	}
}
