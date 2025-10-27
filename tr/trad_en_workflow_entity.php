<?php
class WorkflowEntityEnTranslator{

    public static function initData()
    {
        $trad = [];
	$trad["workflow_entity"]["step1"] = "Definition";

	$trad["workflow_entity"]["workflowentity.single"] = "Workflow entity";
	$trad["workflow_entity"]["workflowentity.new"] = "new";
	$trad["workflow_entity"]["workflow_entity"] = "Workflow entitys";
	$trad["workflow_entity"]["workflow_module_id"] = "Module";
	$trad["workflow_entity"]["entity_name_ar"] = "Entity name -   Ar";
	$trad["workflow_entity"]["entity_name_en"] = "Entity name -   en";
	$trad["workflow_entity"]["entity_description_ar"] = "Entity description - ar";
	$trad["workflow_entity"]["entity_description_en"] = "Entity description - en";
	$trad["workflow_entity"]["lookup_code"] = "lookup code";
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new WorkflowEntityArTranslator();
		return new WorkflowEntity();
	}
}