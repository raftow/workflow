<?php

class JobRunResultArTranslator
{
	public static function initData()
	{
		$trad = [];

		$trad["job_run_result"]["jobrunresult.single"] = "نتيجة تنفيذ مهمة آلية";
		$trad["job_run_result"]["jobrunresult.new"] = "جديد(ة)";
		$trad["job_run_result"]["job_run_result"] = "نتائج تنفيذات المهام الآلية";
		$trad["job_run_result"]["job_run_id"] = "تعريف تنفيذ مهمة آلية";
		$trad["job_run_result"]["item"] = "عنصر النتيجة";
		$trad["job_run_result"]["result_code"] = "رمز الحقل";
		$trad["job_run_result"]["result_value"] = "قيمة الحقل";
		// steps
		return $trad;
	}

	public static function getInstance()
	{
		if (false) return new JobRunResultEnTranslator();
		return new JobRunResult();
	}
}
