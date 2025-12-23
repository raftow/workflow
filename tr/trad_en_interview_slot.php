<?php

class InterviewSlotEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["interview_slot"]["interviewslot.single"] = "Interview Slot";
		$trad["interview_slot"]["interviewslot.new"] = "new";
		$trad["interview_slot"]["interview_slot"] = "Interview Slot";
		$trad["interview_slot"]["name_ar"] = "Arabic Interview slot name";
		$trad["interview_slot"]["name_en"] = "English Interview slot name";
		$trad["interview_slot"]["desc_ar"] = "Arabic Interview slot description";
		$trad["interview_slot"]["desc_en"] = "English Interview slot description";
		$trad["interview_slot"]["slot_model_id"] = "Slot Model";
		$trad["interview_slot"]["interview_date"] = "date";
		$trad["interview_slot"]["start_time"] = "text.8";
		$trad["interview_slot"]["end_time"] = "text.8";
		$trad["interview_slot"]["duration"] = "int.5";
		$trad["interview_slot"]["capacity"] = "int.5";
		$trad["interview_slot"]["booked_seats_count"] = "int.5";
		$trad["interview_slot"]["interview_type"] = "enum";
		$trad["interview_slot"]["location"] = "text.200";
		$trad["interview_slot"]["virtual_meeting_url"] = "text.200";
		$trad["interview_slot"]["workflow_commitee_id_"] = "Workflow commitee";
		$trad["interview_slot"]["interview_slot_status_id"] = "Interview slot status";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new InterviewSlotArTranslator();
		return new InterviewSlot();
	}
}