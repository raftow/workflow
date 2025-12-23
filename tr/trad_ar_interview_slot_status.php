<?php

class InterviewSlotStatusArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["interview_slot_status"]["interviewslotstatus.single"] = "حالة موعد مقابلة";
		$trad["interview_slot_status"]["interviewslotstatus.new"] = "جديد(ة)";
		$trad["interview_slot_status"]["interview_slot_status"] = "حالات موعد مقابلة";
		$trad["interview_slot_status"]["name_ar"] = "مسمى  بالعربية";
		$trad["interview_slot_status"]["name_en"] = "مسمى  بالانجليزية";
		$trad["interview_slot_status"]["desc_ar"] = "وصف  بالعربية";
		$trad["interview_slot_status"]["desc_en"] = "وصف  بالانجليزية";
		$trad["interview_slot_status"]["validated_by"] = "تم إعتماده من طرف";
		$trad["interview_slot_status"]["validated_at"] = "تم إعتماده بتاريخ";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new InterviewSlotStatusEnTranslator();
		return new InterviewSlotStatus();
	}
}