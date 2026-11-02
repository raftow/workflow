<?php

class SlotModelEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["slot_model"]["slotmodel.single"] = "Slot Model";
		$trad["slot_model"]["slotmodel.new"] = "new";
		$trad["slot_model"]["slot_model"] = "Slot model";
		$trad["slot_model"]["name_ar"] = "Arabic Slot model name";
		$trad["slot_model"]["name_en"] = "English Slot model name";
		$trad["slot_model"]["desc_ar"] = "Arabic Slot model description";
		$trad["slot_model"]["desc_en"] = "English Slot model description";
		$trad["slot_model"]["interview_type_pattern_id"] = "Interview type pattern";
		$trad["slot_model"]["application_plan_id"] = "Application plan";
		$trad["slot_model"]["academic_program_id"] = "Academic program";
		$trad["slot_model"]["workflow_stage_id_"] = "int.11";
		$trad["slot_model"]["interview_date"] = "date";
		$trad["slot_model"]["start_time"] = "Start time";
		$trad["slot_model"]["end_time"] = "text.8";
		$trad["slot_model"]["total_duration"] = "int.5";
		$trad["slot_model"]["single_duration"] = "int.5";
		$trad["slot_model"]["single_interviews_total"] = "int.5";
		$trad["slot_model"]["capacity"] = "int.5";
		$trad["slot_model"]["interview_type"] = "enum";
		$trad["slot_model"]["room_location"] = "text.200";
		$trad["slot_model"]["workflow_commitee_id_"] = "Workflow commitee";
		$trad["slot_model"]["buffer_minutes"] = "int.5";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new SlotModelArTranslator();
		return new SlotModel();
	}
}