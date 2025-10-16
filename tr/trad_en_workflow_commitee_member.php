<?php
class WorkflowCommiteeMemberEnTranslator{

    public static function initData()
    {
        $trad = [];

	$trad["workflow_commitee_member"]["workflowcommiteemember.single"] = "Workflow commitee member";
	$trad["workflow_commitee_member"]["workflowcommiteemember.new"] = "new";
	$trad["workflow_commitee_member"]["workflow_commitee_member"] = "Workflow commitee members";
	$trad["workflow_commitee_member"]["workflow_commitee_id"] = "Committee";
	$trad["workflow_commitee_member"]["workflow_employee_id"] = "Employee";
	$trad["workflow_commitee_member"]["workflow_role_id"] = "Role";
	$trad["workflow_commitee_member"]["workflow_task_mfk"] = "tasks";
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new WorkflowCommiteeMemberArTranslator();
		return new WorkflowCommiteeMember();
	}
}