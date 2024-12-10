<?php

class WorkflowFileArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["workflow_file"]["workflowfile.single"] = "Workflow file";
		$trad["workflow_file"]["workflowfile.new"] = "جديد(ة)";
		$trad["workflow_file"]["workflow_file"] = "Workflow files";
		$trad["workflow_file"]["doc_type_id"] = "الdoc_type.single";
		$trad["workflow_file"]["afile_time"] = "وقت";
		$trad["workflow_file"]["is_ok"] = "التثبت الآلي من صحة البيانات";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
		return new WorkflowFile();
	}
}