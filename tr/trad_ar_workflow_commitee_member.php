<?php
class WorkflowCommiteeMemberArTranslator{

    public static function initData()
    {
        $trad = [];

	$trad["workflow_commitee_member"]["workflowcommiteemember.single"] = "عضو لجنة";
	$trad["workflow_commitee_member"]["workflowcommiteemember.new"] = "جديد ة";
	$trad["workflow_commitee_member"]["workflow_commitee_member"] = "أعضاء اللجان";
	$trad["workflow_commitee_member"]["workflow_commitee_id"] = "اللجنة";
	$trad["workflow_commitee_member"]["workflow_employee_id"] = "الموظف";
	$trad["workflow_commitee_member"]["workflow_role_id"] = "الوظيفة";
	$trad["workflow_commitee_member"]["workflow_task_mfk"] = "المهام";
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new WorkflowCommiteeMemberEnTranslator();
		return new WorkflowCommiteeMember();
	}
}