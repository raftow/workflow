<?php
class WorkflowEventEnTranslator{

    public static function initData()
    {
        $trad = [];
	$trad["workflow_event"]["step1"] = "Definition";

	$trad["workflow_event"]["workflowevent.single"] = "Workflow event";
	$trad["workflow_event"]["workflowevent.new"] = "new";
	$trad["workflow_event"]["workflow_event"] = "Workflow events";
	$trad["workflow_event"]["workflow_module_id"] = "Module";
	$trad["workflow_event"]["workflow_entity_id"] = "Entity";
	$trad["workflow_event"]["event_name_ar"] = "Event name -   Ar";
	$trad["workflow_event"]["event_name_en"] = "Event name -   en";
	$trad["workflow_event"]["event_description_ar"] = "Event description - ar";
	$trad["workflow_event"]["event_description_en"] = "Event description - en";
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new WorkflowEventArTranslator();
		return new WorkflowEvent();
	}
}