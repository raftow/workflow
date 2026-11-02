<?php
class WorkflowEntityArTranslator{

    public static function initData()
    {
        $trad = [];
	$trad["workflow_entity"]["step1"] = "التعريف";

	$trad["workflow_entity"]["workflowentity.single"] = "كيان";
	$trad["workflow_entity"]["workflowentity.new"] = "جديد";
	$trad["workflow_entity"]["workflow_entity"] = "كيانات";
	$trad["workflow_entity"]["workflow_module_id"] = "التطبيق";
	$trad["workflow_entity"]["entity_name_ar"] = "اسم الكيان - عربي";
	$trad["workflow_entity"]["entity_name_en"] = "اسم الكيان - انجليزي";
	$trad["workflow_entity"]["entity_description_ar"] = "وصف الكيان - عربي";
	$trad["workflow_entity"]["entity_description_en"] = "وصف الكيان - انجليزي";
	$trad["workflow_entity"]["lookup_code"] = "";
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new WorkflowEntityEnTranslator();
		return new WorkflowEntity();
	}
}