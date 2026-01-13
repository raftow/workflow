<?php

class WorkflowEmployeeEnTranslator
{
	public static function initData()
	{
		$trad = [];

		$trad["workflow_employee"]["workflowemployee.single"] = "Workflow employee";
		$trad["workflow_employee"]["workflowemployee.new"] = "new";
		$trad["workflow_employee"]["workflow_employee"] = "Workflow employees";
		$trad["workflow_employee"]["orgunit_id"] = "Organization / Department";
		$trad["workflow_employee"]["workflow_orgunit_id"] = "Workflow Organization / Department";
		$trad["workflow_employee"]["employee_id"] = "The Employee";
		$trad["workflow_employee"]["email"] = "e-mail";
		$trad["workflow_employee"]["approved"] = "approved";
		$trad["workflow_employee"]["admin"] = "admin";
		$trad["workflow_employee"]["super_admin"] = "super_admin";
		$trad["workflow_employee"]["requests_count"] = "Request count";
		$trad["workflow_employee"]["done_requests_count"] = "done requests count";
		$trad["workflow_employee"]["ongoing_requests_count"] = "ongoing requests count";
		$trad["workflow_employee"]["statif_pct"] = "statif_pct";
		$trad["workflow_employee"]["currentRequests"] = "Current Requests";
		$trad["workflow_employee"]["finishedRequests"] = "finished Requests";
		$trad["workflow_employee"]["allOrgunitList"] = "allOrgunitList";
		// steps
		$trad["workflow_employee"]["step1"] = "General data";
		$trad["workflow_employee"]["step2"] = "Personal information";
		$trad["workflow_employee"]["step3"] = "Permissions";
		$trad['workflow_employee']['step4ّ'] = 'Inbox';
		$trad['workflow_employee']['inbox'] = 'Inbox';
		return $trad;
	}

	public static function getInstance()
	{
		return new WorkflowEmployee();
	}
}
