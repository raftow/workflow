<?php

class InterviewBookingEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["interview_booking"]["interviewbooking.single"] = "Interview Booking";
		$trad["interview_booking"]["interviewbooking.new"] = "new";
		$trad["interview_booking"]["interview_booking"] = "Interview Booking";
		$trad["interview_booking"]["name_ar"] = "Arabic Interview booking name";
		$trad["interview_booking"]["name_en"] = "English Interview booking name";
		$trad["interview_booking"]["desc_ar"] = "Arabic Interview booking description";
		$trad["interview_booking"]["desc_en"] = "English Interview booking description";
		$trad["interview_booking"]["interview_slot_id"] = "Interview Slot";
		$trad["interview_booking"]["applicant_id"] = "Applicant";
		$trad["interview_booking"]["application_plan_id"] = "Application plan";
		$trad["interview_booking"]["application_simulation_id"] = "Application simulation";
		$trad["interview_booking"]["booking_status_id"] = "Booking status";
		$trad["interview_booking"]["booked_at"] = "date";
		$trad["interview_booking"]["booked_by"] = "int.11";
		$trad["interview_booking"]["cancelled_at"] = "date";
		$trad["interview_booking"]["cancelled_by"] = "int.11";
		$trad["interview_booking"]["interview_cancellation_reason_id"] = "Interview cancellation reason";
		$trad["interview_booking"]["can_reschedule_ind"] = "char.1";
		$trad["interview_booking"]["can_cancel_ind"] = "text.1";
		$trad["interview_booking"]["no_show_flag"] = "char.1";
		$trad["interview_booking"]["interviewer"] = "text.200";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new InterviewBookingArTranslator();
		return new InterviewBooking();
	}
}