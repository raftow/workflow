<?php
class WorkflowTaskArTranslator{

    public static function initData()
    {
        $trad = [];

	$trad["workflow_task"]["workflowtask.single"] = "مهمة";
	$trad["workflow_task"]["workflowtask.new"] = "جديد ة";
	$trad["workflow_task"]["workflow_task"] = "المهام";
	$trad["workflow_task"]["task_name_ar"] = "اسم المهمة - عربي";
	$trad["workflow_task"]["task_name_en"] = "اسم المهمة - انجليزي";
	$trad["workflow_task"]["task_description_ar"] = "وصف المهمة - عربي";
	$trad["workflow_task"]["task_description_en"] = "وصف المهمة - انجليزي";
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new WorkflowTaskEnTranslator();
		return new WorkflowTask();
	}
}