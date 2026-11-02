<?php

class InterviewTypePatternArTranslator
{
	public static function initData()
	{
		$trad = [];

		$trad["interview_type_pattern"]["interviewtypepattern.single"] = "نموذج مقابلة";
		$trad["interview_type_pattern"]["interviewtypepattern.new"] = "جديد(ة)";
		$trad["interview_type_pattern"]["interview_type_pattern"] = "نماذج المقابلات";
		$trad["interview_type_pattern"]["name_ar"] = "مسمى  بالعربية";
		$trad["interview_type_pattern"]["name_en"] = "مسمى  بالانجليزية";
		$trad["interview_type_pattern"]["desc_ar"] = "وصف  بالعربية";
		$trad["interview_type_pattern"]["desc_en"] = "وصف  بالانجليزية";
		$trad["interview_type_pattern"]["workflow_stage_id_"] = "مرحلة القبول";
		$trad["interview_type_pattern"]["buffer_hours"] = "تمكين الحجز بعد";
		$trad["interview_type_pattern"]["booking_program_ind"] = "حجز خاص بالبرنامج";
		$trad["interview_type_pattern"]["workflow_stage_id"] = "مرحلة القبول";
		$trad["interview_type_pattern"]["can_cancel_ind"] = "يمكن الإلغاء";
		$trad["interview_type_pattern"]["max_reschedule"] = "الحد الأقصى لإعادة الجدولة";
		$trad["interview_type_pattern"]["manual_booking_ind"] = "حجز يدوي";
		$trad["interview_type_pattern"]["add_interview_mandatory_ind"] = "يجب إضافة مواعيد قبل الإحالة للمقابلة";
		// steps
		return $trad;
	}

	public static function getInstance()
	{
		if (false) return new InterviewTypePatternEnTranslator();
		return new InterviewTypePattern();
	}
}
