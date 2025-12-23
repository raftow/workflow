<?php

class InterviewTypePatternEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["interview_type_pattern"]["interviewtypepattern.single"] = "Interview type pattern";
		$trad["interview_type_pattern"]["interviewtypepattern.new"] = "new";
		$trad["interview_type_pattern"]["interview_type_pattern"] = "Interview type pattern";
		$trad["interview_type_pattern"]["name_ar"] = "Arabic Interview type pattern name";
		$trad["interview_type_pattern"]["name_en"] = "English Interview type pattern name";
		$trad["interview_type_pattern"]["desc_ar"] = "Arabic Interview type pattern description";
		$trad["interview_type_pattern"]["desc_en"] = "English Interview type pattern description";
		$trad["interview_type_pattern"]["workflow_stage_id_"] = "int.11";
		$trad["interview_type_pattern"]["buffer_hours"] = "Enable booking after";
		$trad["interview_type_pattern"]["booking_program_ind"] = "char.1";
		$trad["interview_type_pattern"]["Max_reschedule"] = "Max reschedule";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new InterviewTypePatternArTranslator();
		return new InterviewTypePattern();
	}
}