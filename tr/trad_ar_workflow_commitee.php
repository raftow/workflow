<?php
class WorkflowCommiteeArTranslator{

    public static function initData()
    {
        $trad = [];

	$trad["workflow_commitee"]["workflowcommitee.single"] = "لجنة";
	$trad["workflow_commitee"]["workflowcommitee.new"] = "جديد ة";
	$trad["workflow_commitee"]["workflow_commitee"] = "الجان";
	$trad["workflow_commitee"]["commitee_name_ar"] = "اسم اللجنة - عربي";
	$trad["workflow_commitee"]["commitee_name_en"] = "اسم اللجنة - انجليزي";
	$trad["workflow_commitee"]["commitee_description_ar"] = "وصف اللجنة - عربي";
	$trad["workflow_commitee"]["commitee_description_en"] = "وصف اللجنة - انجليزي";
	$trad["workflow_commitee"]["workflow_role_id"] = "دور اللجنة";
	$trad["workflow_commitee"]["secretary_employee_id "] = "سكرتير اللجنة";
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new WorkflowCommiteeEnTranslator();
		return new WorkflowCommitee();
	}
}