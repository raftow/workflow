<?php

class WorkflowConditionArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["workflow_condition"]["workflowcondition.single"] = "شرط";
		$trad["workflow_condition"]["workflowcondition.new"] = "جديد(ة)";
		$trad["workflow_condition"]["workflow_condition"] = "الشروط";
		$trad["workflow_condition"]["name_ar"] = "مسمى  بالعربية";
		$trad["workflow_condition"]["name_en"] = "مسمى  بالانجليزية";
		$trad["workflow_condition"]["desc_ar"] = "وصف  بالعربية";
		$trad["workflow_condition"]["desc_en"] = "وصف  بالانجليزية";
		$trad["workflow_condition"]["workflow_module_id"] = "التطبيق";
		$trad["workflow_condition"]["lookup_code"] = "الرمز";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new WorkflowConditionEnTranslator();
		return new WorkflowCondition();
	}
}