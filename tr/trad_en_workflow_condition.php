<?php

class WorkflowConditionEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["workflow_condition"]["workflowcondition.single"] = "condition";
		$trad["workflow_condition"]["workflowcondition.new"] = "new";
		$trad["workflow_condition"]["workflow_condition"] = "conditions";
		$trad["workflow_condition"]["name_ar"] = "Arabic Workflow condition name";
		$trad["workflow_condition"]["name_en"] = "English Workflow condition name";
		$trad["workflow_condition"]["desc_ar"] = "Arabic Workflow condition description";
		$trad["workflow_condition"]["desc_en"] = "English Workflow condition description";
		$trad["workflow_condition"]["workflow_module_id"] = "Workflow module";
		$trad["workflow_condition"]["lookup_code"] = "Lookup code";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new WorkflowConditionArTranslator();
		return new WorkflowCondition();
	}
}