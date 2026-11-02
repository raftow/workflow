<?php
class WorkflowEventArTranslator{

    public static function initData()
    {
        $trad = [];
	$trad["workflow_event"]["step1"] = "التعريف";

	$trad["workflow_event"]["workflowevent.single"] = "حدث";
	$trad["workflow_event"]["workflowevent.new"] = "جديد";
	$trad["workflow_event"]["workflow_event"] = "أحداث";
	$trad["workflow_event"]["workflow_module_id"] = "التطبيق";
	$trad["workflow_event"]["workflow_entity_id"] = "الكيان";
	$trad["workflow_event"]["event_name_ar"] = "اسم الحدث - عربي";
	$trad["workflow_event"]["event_name_en"] = "اسم الحدث - انجليزي";
	$trad["workflow_event"]["event_description_ar"] = "وصف الحدث - عربي";
	$trad["workflow_event"]["event_description_en"] = "وصف الحدث - انجليزي";
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new WorkflowEventEnTranslator();
		return new WorkflowEvent();
	}
}