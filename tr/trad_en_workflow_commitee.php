<?php
class WorkflowCommiteeEnTranslator{

    public static function initData()
    {
        $trad = [];

			$trad["workflow_commitee"]["workflowcommitee.single"] = "Workflow commitee";
			$trad["workflow_commitee"]["workflowcommitee.new"] = "new";
			$trad["workflow_commitee"]["workflow_commitee"] = "Workflow commitees";
			$trad["workflow_commitee"]["commitee_name_ar"] = "committee name - arabic";
			$trad["workflow_commitee"]["commitee_name_en"] = "Committee name - english";
			$trad["workflow_commitee"]["commitee_description_ar"] = "Committee description - arabic";
			$trad["workflow_commitee"]["commitee_description_en"] = "Committee description - english";
			$trad["workflow_commitee"]["workflow_role_id"] = "workflow role";
			$trad["workflow_commitee"]["secretary_employee_id"] = "Secretary employee";

			$trad["workflow_commitee"]["workflowCommiteeMemberList"] = "Commitee member";
			$trad["workflow_commitee"]["workflowCommiteeScopeList"] = "Commitee Scope";

			$trad["workflow_commitee"]["step1"] = "General";
			$trad["workflow_commitee"]["step2"] = "Commitee Member";
			$trad["workflow_commitee"]["step3"] = "Commitee Scope";
        return $trad;
    }

    public static function getInstance()
	{
                if(false) return new WorkflowCommiteeArTranslator();
		return new WorkflowCommitee();
	}
}