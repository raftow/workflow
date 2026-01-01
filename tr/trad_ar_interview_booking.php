<?php

class InterviewBookingArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["interview_booking"]["interviewbooking.single"] = "حجز المقابلة";
		$trad["interview_booking"]["interviewbooking.new"] = "جديد(ة)";
		$trad["interview_booking"]["interview_booking"] = "حجوزات المقابلة";
		$trad["interview_booking"]["name_ar"] = "مسمى  بالعربية";
		$trad["interview_booking"]["name_en"] = "مسمى  بالانجليزية";
		$trad["interview_booking"]["desc_ar"] = "وصف  بالعربية";
		$trad["interview_booking"]["desc_en"] = "وصف  بالانجليزية";
		$trad["interview_booking"]["interview_slot_id"] = "موعد الالمقابلة";
		$trad["interview_booking"]["applicant_id"] = "المتقدم";
		$trad["interview_booking"]["application_plan_id"] = "خطة التقديم";
		$trad["interview_booking"]["application_simulation_id"] = "الapplication_simulation.single";
		$trad["interview_booking"]["booking_status_id"] = "حالة الحجز";
		$trad["interview_booking"]["booked_at"] = "تم الحجز في";
		$trad["interview_booking"]["booked_by"] = "تم الحجز بواسطة";
		$trad["interview_booking"]["cancelled_at"] = "تم الإلغاء في";
		$trad["interview_booking"]["cancelled_by"] = "تم الإلغاء بواسطة";
		$trad["interview_booking"]["interview_cancellation_reason_id"] = "سبب إلغاء المقابلة";
		$trad["interview_booking"]["can_reschedule_ind"] = "يمكن إعادة الجدولة";
		$trad["interview_booking"]["can_cancel_ind"] = "يمكن الإلغاء";
		$trad["interview_booking"]["no_show_flag"] = "علامة عدم الحضور";
		$trad["interview_booking"]["interviewer"] = "المحاورون";
		$trad["interview_booking"]["workflow_applicant_id"] = "المتقدم";
		$trad["interview_booking"]["workflow_session_id"] = "دورة سير العمل";
   		$trad["interview_booking"]["interview_type_pattern_id"] = "نموذج نوع المقابلة";
		$trad["interview_booking"]["workflow_request_id"] = "طلب سير العمل";
		$trad["interview_booking"]["workflow_scope_id"] = "البرنامج";
		$trad["interview_booking"]["reschedule_count"] = "عدد مرات إعادة الجدولة";

        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new InterviewBookingEnTranslator();
		return new InterviewBooking();
	}
}