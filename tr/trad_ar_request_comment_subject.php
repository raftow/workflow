<?php

class RequestCommentSubjectArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["request_comment_subject"]["requestcommentsubject.single"] = "موضوع ملاحظة";
		$trad["request_comment_subject"]["requestcommentsubject.new"] = "جديد";
		$trad["request_comment_subject"]["request_comment_subject"] = "مواضيع ملاحظات";
		$trad["request_comment_subject"]["name_ar"] = "مسمى  بالعربية";
		$trad["request_comment_subject"]["name_en"] = "مسمى  بالانجليزية";
		$trad["request_comment_subject"]["desc_ar"] = "وصف  بالعربية";
		$trad["request_comment_subject"]["desc_en"] = "وصف  بالانجليزية";
		$trad["request_comment_subject"]["workflow_stage_id"] = "المرحلة";
		$trad["request_comment_subject"]["validated_by"] = "تم إعتماده من طرف";
		$trad["request_comment_subject"]["validated_at"] = "تم إعتماده بتاريخ";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new RequestCommentSubjectEnTranslator();
		return new RequestCommentSubject();
	}
}