<?php

class JobRunArTranslator
{
	public static function initData()
	{
		$trad = [];

		$trad["job_run"]["jobrun.single"] = "تنفيذ مهمة آلية";
		$trad["job_run"]["jobrun.new"] = "جديد(ة)";
		$trad["job_run"]["job_run"] = "تنفيذات المهام الآلية";
		$trad["job_run"]["scjob_id"] = "المهمة الآلية";
		$trad["job_run"]["run_date"] = "تاريخ بداية التنفيذ";
		$trad["job_run"]["run_time"] = "وقت بداية التنفيذ";
		$trad["job_run"]["run_end_date"] = "تاريخ نهاية التنفيذ";
		$trad["job_run"]["run_end_time"] = "وقت نهاية التنفيذ";
		$trad["job_run"]["errors_nb"] = "عدد الأخطاء";
		$trad["job_run"]["warning_nb"] = "عدد التنبيهات";
		$trad["job_run"]["notification_nb"] = "عدد السجلات ";
		$trad["job_run"]["jobRunResultList"] = "قائمة نتائج تنفيذات المهام الآلية";
		$trad["job_run"]["log_path"] = "مسار آثار التنفيذ";
		$trad["job_run"]["comments"] = "ملاحظات";
		$trad["job_run"]["log_view"] = "تتبع الآثار - logfile";

		// steps
		return $trad;
	}

	public static function getInstance()
	{
		if (false) return new JobRunEnTranslator();
		return new JobRun();
	}
}
