<?php

class WorkflowRequestCommentArTranslator
{
	public static function initData()
	{
		$trad = [];

		$trad['workflow_request_comment']['workflowrequestcomment.single'] = 'تعليق أوملاحظة';
		$trad['workflow_request_comment']['workflowrequestcomment.new'] = 'جديد(ة)';
		$trad['workflow_request_comment']['workflow_request_comment'] = 'التعليقات والملاحظات';
		$trad['workflow_request_comment']['name_ar'] = 'مسمى  بالعربية';
		$trad['workflow_request_comment']['name_en'] = 'مسمى  بالانجليزية';
		$trad['workflow_request_comment']['desc_ar'] = 'وصف  بالعربية';
		$trad['workflow_request_comment']['desc_en'] = 'وصف  بالانجليزية';
		$trad['workflow_request_comment']['comment'] = 'نصها';
		$trad['workflow_request_comment']['request_comment_subject_id'] = 'موضوع الملاحظة';
		$trad['workflow_request_comment']['workflow_stage_id'] = 'المرحلة';
		$trad['workflow_request_comment']['workflow_request_id'] = 'الطلب';

		// steps
		return $trad;
	}

	public static function getInstance()
	{
		if (false)
			return new WorkflowRequestCommentEnTranslator();
		return new WorkflowRequestComment();
	}
}
