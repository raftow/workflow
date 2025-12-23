<?php

class InterviewSlotStatusEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["interview_slot_status"]["interviewslotstatus.single"] = "Interview slot status";
		$trad["interview_slot_status"]["interviewslotstatus.new"] = "new";
		$trad["interview_slot_status"]["interview_slot_status"] = "Interview slot statuss";
		$trad["interview_slot_status"]["name_ar"] = "Arabic Slot model name";
		$trad["interview_slot_status"]["name_en"] = "English Slot model name";
		$trad["interview_slot_status"]["desc_ar"] = "Arabic Slot model description";
		$trad["interview_slot_status"]["desc_en"] = "English Slot model description";
		$trad["interview_slot_status"]["validated_by"] = "Validated by";
		$trad["interview_slot_status"]["validated_at"] = "Validated at";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new InterviewSlotStatusArTranslator();
		return new InterviewSlotStatus();
	}
}