<?php

class JobRunEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["job_run"]["jobrun.single"] = "Job run";
		$trad["job_run"]["jobrun.new"] = "new";
		$trad["job_run"]["job_run"] = "Job runs";
		$trad["job_run"]["scjob_id"] = "Scjob";
		$trad["job_run"]["run_date"] = "Run date";
		$trad["job_run"]["run_time"] = "Run time";
		$trad["job_run"]["errors_nb"] = "Errors nb";
		$trad["job_run"]["warning_nb"] = "Warning nb";
		$trad["job_run"]["notification_nb"] = "Notification nb";
		$trad["job_run"]["jobRunResultList"] = "List of Job run results";
		$trad["job_run"]["comments"] = "Comments";
		$trad["job_run"]["creation_user_id"] = "Created by";
		$trad["job_run"]["creation_date"] = "Created at";
		$trad["job_run"]["update_user_id"] = "Updated by";
		$trad["job_run"]["update_date"] = "Updated at";
		$trad["job_run"]["validation_user_id"] = "Validated by";
		$trad["job_run"]["validation_date"] = "Validated at";
		$trad["job_run"]["active"] = "Active";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new JobRunArTranslator();
		return new JobRun();
	}
}