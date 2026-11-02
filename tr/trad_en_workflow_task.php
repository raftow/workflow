<?php
class WorkflowTaskEnTranslator{

    public static function initData()
    {
        $trad = [];

	$trad["workflow_task"]["workflowtask.single"] = "Workflow task";
	$trad["workflow_task"]["workflowtask.new"] = "new";
	$trad["workflow_task"]["workflow_task"] = "Workflow tasks";
	$trad["workflow_task"]["task_name_ar"] = "Task name - arabic";
	$trad["workflow_task"]["task_name_en"] = "Task name - english";
	$trad["workflow_task"]["task_description_ar"] = "Task description - arabic";
	$trad["workflow_task"]["task_description_en"] = "Task description - english";
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new WorkflowTaskArTranslator();
		return new WorkflowTask();
	}
}