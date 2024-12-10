<?php

class WorkflowFileEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["workflow_file"]["workflowfile.single"] = "Workflow file";
		$trad["workflow_file"]["workflowfile.new"] = "new";
		$trad["workflow_file"]["workflow_file"] = "Workflow files";
		$trad["workflow_file"]["is_ok"] = "Data is ok";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
		return new WorkflowFile();
	}
}