<?php

class WorkflowFileArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["workflow_file"]["workflowfile.single"] = "ملف";
		$trad["workflow_file"]["workflowfile.new"] = "جديد";
		$trad["workflow_file"]["workflow_file"] = "الملفات";
		$trad["workflow_file"]["doc_type_id"] = "نوع الملف";
		$trad["workflow_file"]["afile_date"] = "تاريخ  تحميل الملف";
		$trad["workflow_file"]["afile_time"] = "وقت تحميل الملف";
		$trad["workflow_file"]["afile_name"] = "مسمى الملف";
		$trad["workflow_file"]["is_ok"] = "التثبت الآلي من صحة البيانات";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
		return new WorkflowFile();
	}
}