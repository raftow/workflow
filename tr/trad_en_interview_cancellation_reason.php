<?php

class InterviewCancellationReasonEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["interview_cancellation_reason"]["interviewcancellationreason.single"] = "Interview cancellation reason";
		$trad["interview_cancellation_reason"]["interviewcancellationreason.new"] = "new";
		$trad["interview_cancellation_reason"]["interview_cancellation_reason"] = "Interview cancellation reasons";
		$trad["interview_cancellation_reason"]["name_ar"] = "Arabic Interview slot name";
		$trad["interview_cancellation_reason"]["name_en"] = "English Interview slot name";
		$trad["interview_cancellation_reason"]["desc_ar"] = "Arabic Interview slot description";
		$trad["interview_cancellation_reason"]["desc_en"] = "English Interview slot description";
		$trad["interview_cancellation_reason"]["validated_by"] = "Validated by";
		$trad["interview_cancellation_reason"]["validated_at"] = "Validated at";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new InterviewCancellationReasonArTranslator();
		return new InterviewCancellationReason();
	}
}