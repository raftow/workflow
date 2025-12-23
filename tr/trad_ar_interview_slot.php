<?php

class InterviewSlotArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["interview_slot"]["interviewslot.single"] = "موعد المقابلة";
		$trad["interview_slot"]["interviewslot.new"] = "جديد(ة)";
		$trad["interview_slot"]["interview_slot"] = "مواعيد المقابلة";
		$trad["interview_slot"]["name_ar"] = "مسمى  بالعربية";
		$trad["interview_slot"]["name_en"] = "مسمى  بالانجليزية";
		$trad["interview_slot"]["desc_ar"] = "وصف  بالعربية";
		$trad["interview_slot"]["desc_en"] = "وصف  بالانجليزية";
		$trad["interview_slot"]["slot_model_id"] = "نموذج موعد المقابلة";
		$trad["interview_slot"]["interview_date"] = "تاريخ المقابلة";
		$trad["interview_slot"]["start_time"] = "وقت البداية";
		$trad["interview_slot"]["end_time"] = "وقت النهاية";
		$trad["interview_slot"]["duration"] = "مدة المقابلة (دقائق)";
		$trad["interview_slot"]["capacity"] = "الطاقة الاستيعابية: عدد المتقدمين المسموح به لكل موعد";
		$trad["interview_slot"]["booked_seats_count"] = "عدد المواعيد المحجوزة";
		$trad["interview_slot"]["interview_type"] = "نوع المقابلة";
		$trad["interview_slot"]["location"] = "الموقع";
		$trad["interview_slot"]["virtual_meeting_url"] = "رابط الاجتماع الافتراضي";
		$trad["interview_slot"]["workflow_commitee_id_"] = "اللجنة/المحاورون";
		$trad["interview_slot"]["interview_slot_status_id"] = "Interview slot status";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new InterviewSlotEnTranslator();
		return new InterviewSlot();
	}
}