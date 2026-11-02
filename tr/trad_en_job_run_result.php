<?php

class JobRunResultEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["job_run_result"]["jobrunresult.single"] = "Job run result";
		$trad["job_run_result"]["jobrunresult.new"] = "new";
		$trad["job_run_result"]["job_run_result"] = "Job run results";
		$trad["job_run_result"]["job_run_id"] = "Job run";
		$trad["job_run_result"]["item"] = "Item";		
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new JobRunResultArTranslator();
		return new JobRunResult();
	}
}