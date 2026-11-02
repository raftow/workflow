<?php

class WorkflowOrgunitEnTranslator
{
	public static function initData()
	{
		$trad = [];
		$trad['workflow_orgunit']['workfloworgunit.single'] = 'Workflow orgunit';
		$trad['workflow_orgunit']['workfloworgunit.new'] = 'new';
		$trad['workflow_orgunit']['workflow_orgunit'] = 'Workflow orgunits';
		$trad['workflow_orgunit']['orgunit_id'] = 'Orgunit';
		$trad['workflow_orgunit']['service_mfk'] = 'Service mfk';
		$trad['workflow_orgunit']['requests_nb'] = 'Requests nb';


		$trad['workflow_orgunit']['requests_count'] = 'Total ongoing requests';
		$trad['workflow_orgunit']['requests_count.tooltip'] = 'Tooltip for total ongoing requests';
		$trad['workflow_orgunit']['new_requests_count'] = 'Total new requests';
		$trad['workflow_orgunit']['new_requests_count.tooltip'] = 'New requests are those not yet assigned to a supervisor or workflow orgunit';
		$trad['workflow_orgunit']['allEmployeeList'] = 'All employees of the workflow orgunit';
		$trad['workflow_orgunit']['unAssignedRequests'] = 'Unassigned requests';
		$trad['workflow_orgunit']['currentRequests'] = 'Current requests';

		$trad['workflow_orgunit']['step1'] = 'General data';
		$trad['workflow_orgunit']['step2'] = 'Employees';
		$trad['workflow_orgunit']['step3'] = 'Assigned requests';
		$trad['workflow_orgunit']['step4'] = 'Assign employees';
		$trad['workflow_orgunit']['step5'] = 'Statistics settings';
		$trad['workflow_orgunit']['inbox'] = 'Inbox';


		$trad['workflow_orgunit']['inbox'] = 'صندوق الوارد';

		$trad['workflow_orgunit']['tempEmployeeList'] = 'Employee assignment requests';

		$trad['workflow_orgunit']['perf_stats_days'] = 'Number of days for performance report';
		$trad['workflow_orgunit']['standard_stats_days'] = 'Number of days for standard reports';
		$trad['workflow_orgunit']['satisfaction_stats_days'] = 'Number of days for customer satisfaction report';
		$trad['workflow_orgunit']['late_days'] = 'Maximum number of days to respond to a customer';
		$trad['workflow_orgunit']['late_days.tooltip'] = 'Requests are considered late after this number of days in reports';

		return $trad;
	}

	public static function getInstance()
	{
		return new WorkflowOrgunit();
	}
}
