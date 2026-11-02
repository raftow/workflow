<?php

class RequestCommentSubjectEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["request_comment_subject"]["requestcommentsubject.single"] = "Request comment subject";
		$trad["request_comment_subject"]["requestcommentsubject.new"] = "new";
		$trad["request_comment_subject"]["request_comment_subject"] = "Request comment subjects";
		$trad["request_comment_subject"]["name_ar"] = "Arabic Workflow session name";
		$trad["request_comment_subject"]["name_en"] = "English Workflow session name";
		$trad["request_comment_subject"]["desc_ar"] = "Arabic Workflow session description";
		$trad["request_comment_subject"]["desc_en"] = "English Workflow session description";
		$trad["request_comment_subject"]["validated_by"] = "Validated by";
		$trad["request_comment_subject"]["validated_at"] = "Validated at";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new RequestCommentSubjectArTranslator();
		return new RequestCommentSubject();
	}
}