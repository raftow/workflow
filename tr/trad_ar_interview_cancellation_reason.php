<?php

class InterviewCancellationReasonArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["interview_cancellation_reason"]["interviewcancellationreason.single"] = "سبب إلغاء المقابلة";
		$trad["interview_cancellation_reason"]["interviewcancellationreason.new"] = "جديد(ة)";
		$trad["interview_cancellation_reason"]["interview_cancellation_reason"] = "أسباب إلغاء المقابلة";
		$trad["interview_cancellation_reason"]["name_ar"] = "مسمى  بالعربية";
		$trad["interview_cancellation_reason"]["name_en"] = "مسمى  بالانجليزية";
		$trad["interview_cancellation_reason"]["desc_ar"] = "وصف  بالعربية";
		$trad["interview_cancellation_reason"]["desc_en"] = "وصف  بالانجليزية";
		$trad["interview_cancellation_reason"]["validated_by"] = "تم إعتماده من طرف";
		$trad["interview_cancellation_reason"]["validated_at"] = "تم إعتماده بتاريخ";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new InterviewCancellationReasonEnTranslator();
		return new InterviewCancellationReason();
	}
}