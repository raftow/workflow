<?php

class Scjob extends AFWObject
{

	public static $MY_ATABLE_ID = 3607;
	// إجراء إحصائيات حول المهام الآلية 
	public static $BF_STATS_SCJOB = 103880;
	// إدارة المهام الآلية 
	public static $BF_QEDIT_SCJOB = 103875;
	// إنشاء مهمة آلية 
	public static $BF_EDIT_SCJOB = 103874;
	// الاستعلام عن مهمة آلية 
	public static $BF_QSEARCH_SCJOB = 103879;
	// البحث في المهام الآلية 
	public static $BF_SEARCH_SCJOB = 103878;
	// عرض تفاصيل مهمة آلية 
	public static $BF_DISPLAY_SCJOB = 103877;
	// مسح مهمة آلية 
	public static $BF_DELETE_SCJOB = 103876;




	public function __construct()
	{
		parent::__construct("scjob", "id", "workflow");
		WorkflowScjobAfwStructure::initInstance($this);    
	}

	public static function loadById($id)
	{
		$obj = new Scjob();
		$obj->select_visibilite_horizontale();
		if ($obj->load($id)) {
			return $obj;
		} else return null;
	}

	public function getLastRun()
	{
		$file_dir_name = dirname(__FILE__);
		require_once("$file_dir_name/../atm/job_run.php");
		$jr = new JobRun();
		$jr->select("scjob_id", $this->getId());
		if ($jr->load()) return $jr;
		else return null;
	}

	public function list_of_frequency()
	{
		$list_of_items = array();
		$list_of_items[1] = "كل ساعة";  //     code : 1_HOUR
		$list_of_items[2] = "كل 4 ساعات";  //     code : 4_HOUR
		$list_of_items[3] = "كل 8 ساعات";  //     code : 8_HOUR
		$list_of_items[4] = "كل 12 ساعة";  //     code : 12_HOUR 
		$list_of_items[5] = "يومي";  //     code : DAILY 
		$list_of_items[6] = "أسبوعي";  //     code : WEEKLY 
		$list_of_items[7] = "شهري";  //     code : MONTHLY 
		$list_of_items[8] = "سنوي";  //     code : YEARLY
		$list_of_items[9] = "كل ربع ساعة";  //     code : QUARTER
		$list_of_items[10] = "كل نصف ساعة";  //     code : HALF
		$list_of_items[11] = "متوقف";  //     code : STOPPED
		$list_of_items[12] = "كل 6 ساعات";  //     code : 4_HOUR

		return  $list_of_items;
	}

	public function calcMax_time_of_exec()
	{
		return self::max_time_of_exec_from_frequency(intval($this->getVal("frequency")));
	}

	public function calcPast_period()
	{
		return self::past_period_from_frequency(intval($this->getVal("frequency")));
	}


	public static function max_time_of_exec_from_frequency($freq)
	{
		if ($freq == 1) return 1.0;
		if ($freq == 2) return 2.0;
		if ($freq == 3) return 3.0;
		if ($freq == 4) return 4.0;
		if ($freq == 5) return 5.0;
		if ($freq == 6) return 6.0;
		if ($freq == 7) return 7.0;
		if ($freq == 8) return 8.0;
		if ($freq == 9) return 0.25;
		if ($freq == 10) return 0.5;

		return  1.0;
	}

	public static function past_period_from_frequency($freq)
	{
		if ($freq == 1) return 5;
		if ($freq == 2) return 15;
		if ($freq == 3) return 20;
		if ($freq == 4) return 30;
		if ($freq == 5) return 60;
		if ($freq == 6) return 180;
		if ($freq == 7) return 730;
		if ($freq == 8) return 3660;
		if ($freq == 9) return 1;
		if ($freq == 10) return 2;

		return  3;
	}

	public static function loadByMainIndex($job_code, $create_obj_if_not_found = false)
	{
		$obj = new Scjob();
		if (!$job_code) $obj->_error("loadByMainIndex : job_code is mandatory field");


		$obj->select("job_code", $job_code);

		if ($obj->load()) {
			if ($create_obj_if_not_found) $obj->activate();
			return $obj;
		} elseif ($create_obj_if_not_found) {
			$obj->set("job_code", $job_code);

			$obj->insert();
			$obj->is_new = true;
			return $obj;
		} else return null;
	}


	public function getDisplay($lang = "ar")
	{

		$data = array();
		$link = array();


		list($data[0], $link[0]) = $this->displayAttribute("job_code", false, $lang);
		list($data[1], $link[1]) = $this->displayAttribute("job_name", false, $lang);


		return implode(" - ", $data);
	}



	protected function getOtherLinksArray($mode, $genereLog = false, $step = "all")
	{
		global $lang;
		// $objme = AfwSession::getUserConnected();
		// $me = ($objme) ? $objme->id : 0;

		$otherLinksArray = $this->getOtherLinksArrayStandard($mode, $genereLog, $step);
		$my_id = $this->getId();
		$displ = $this->getDisplay($lang);



		// check errors on all steps (by default no for optimization)
		// rafik don't know why this : \//  = false;

		return $otherLinksArray;
	}

	protected function getPublicMethods()
	{

		$pbms = array();

		$color = "green";
		$title_ar = "xxxxxxxxxxxxxxxxxxxx";
		//$pbms["xc123B"] = array("METHOD"=>"methodName","COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true, "BF-ID"=>"");



		return $pbms;
	}


	public function beforeDelete($id, $id_replace)
	{
		global $server_db_prefix;

		if ($id) {
			if ($id_replace == 0) {
				// FK part of me - not deletable 


				// FK part of me - deletable 
				// atm.job_run-المهمة الآلية	scjob_id  أنا تفاصيل لها-OneToMany
				$this->execQuery("delete from ${server_db_prefix}atm.job_run where scjob_id = '$id' ");


				// FK not part of me - replaceable 



				// MFK

			} else {
				// FK on me 
				// atm.job_run-المهمة الآلية	scjob_id  أنا تفاصيل لها-OneToMany
				$this->execQuery("update ${server_db_prefix}atm.job_run set scjob_id='$id_replace' where scjob_id='$id' ");


				// MFK


			}
			return true;
		}
	}


	public function newRun($log_file_name)
	{
		global $hijri_current_date;
		date_default_timezone_set("Asia/Riyadh");
		require_once("job_run.php");
		$jrun = JobRun::loadByMainIndex($this->getId(), $hijri_current_date, date("H:i:s"), $create_obj_if_not_found = true);

		$jrun->set("log_path", $log_file_name);
		$jrun->commit();

		return $jrun;
	}

	public function getFormuleResult($attribute, $what = 'value')
	{
		global $server_db_prefix, $objme, $images;

		$file_dir_name = dirname(__FILE__);

		switch ($attribute) {
			case "run_date_min":
				require_once("$file_dir_name/../pag/common_date.php");
				return AfwDateHelper::shiftHijriDate("", -$this->calcPast_period());
				break;

			case "last_run_records":

				require_once("job_run.php");
				$jrun = new JobRun();

				$jrun->select("scjob_id", $this->getId());
				$run_date_max = $jrun->func("max(run_date)");
				if ($run_date_max) {
					$jrun2 = new JobRun();
					$jrun2->select("scjob_id", $this->getId());
					$jrun2->select("run_date", $run_date_max);

					$run_time_max = $jrun2->func("max(run_time)");
					if ($run_time_max) {
						$jrun3 = new JobRun();
						$jrun3->select("scjob_id", $this->getId());
						$jrun3->select("run_date", $run_date_max);
						$jrun3->select("run_time", $run_time_max);

						$jrun3->load();

						return $jrun3->getVal("notification_nb");
					}
				} else {
					$run_date_time_max = "0000-00-00 00:00:00";
				}
				return $run_date_time_max;

				break;
			case "last_run_date_time":
				require_once("job_run.php");
				$jrun = new JobRun();

				$jrun->select("scjob_id", $this->getId());
				$run_date_max = $jrun->func("max(run_date)");
				if ($run_date_max) {
					$jrun2 = new JobRun();
					$jrun2->select("scjob_id", $this->getId());
					$jrun2->select("run_date", $run_date_max);

					$run_time_max = $jrun2->func("max(run_time)");

					require_once("$file_dir_name/../pag/common_date.php");

					$run_date_time_max = AfwDateHelper::hijriToGreg($run_date_max) . " " . $run_time_max;
				} else {
					$run_date_time_max = "0000-00-00 00:00:00";
				}
				return $run_date_time_max;
				break;
		}
	}


	protected function getSpecificDataErrors($lang="ar",$show_val=true,$step="all",$erroned_attribute=null,$stop_on_first_error=false, $start_step=null, $end_step=null)
	{
		date_default_timezone_set("Asia/Riyadh");

		$sp_errors = array();

		$file_dir_name = dirname(__FILE__);
		require_once("$file_dir_name/../pag/common_date.php");

		$last_run_date_time = $this->getVal("last_run_date_time");
		$tawwa = date("Y-m-d H:i:s");
		$diff = diff_datetime_in_sec($tawwa, $last_run_date_time);

		$freq = $this->getVal("frequency");

		$max_diff = 0; //متوقف";  //     code : STOPPED


		if ($freq == 9) $max_diff = 900; //كل ربع ساعة";  //     code : QUARTER
		if ($freq == 10) $max_diff = 1800; //كل نصف ساعة";  //     code : QUARTER
		if ($freq == 1) $max_diff = 3600; //كل ساعة";  //     code : 1_HOUR
		if ($freq == 1) $max_diff = 3600; //كل ساعة";  //     code : 1_HOUR
		if ($freq == 2) $max_diff = 3600 * 4; //"كل 4 ساعات";  //     code : 4_HOUR
		if ($freq == 3) $max_diff = 3600 * 8; //كل 8 ساعات";  //     code : 8_HOUR
		if ($freq == 4) $max_diff = 3600 * 12; //كل 12 ساعة";  //     code : 12_HOUR 
		if ($freq == 5) $max_diff = 3600 * 24; //يومي";  //     code : DAILY 
		if ($freq == 6) $max_diff = 3600 * 24 * 7; //أسبوعي";  //     code : WEEKLY 
		if ($freq == 7) $max_diff = 3600 * 24 * 31; //شهري";  //     code : MONTHLY 
		if ($freq == 8) $max_diff = 3600 * 24 * 366; //سنوي";  //     code : YEARLY



		if (($max_diff > 0) and ($diff > $max_diff)) {
			$sp_errors["last_run_date_time"] = "job have not run since too much time";
			//$sp_errors["last_run_date_time"] .= "log : ($tawwa - $last_run_date_time = $diff > $max_diff)";
		} else {
			// $sp_errors["last_run_date_time"] = "log : $tawwa - $last_run_date_time = $diff < $max_diff";
		}

		$lrun = $this->getLastRun();
		if (!$lrun) {
			$sp_errors["last_run_date_time"] = "job have'nt run along time ago";
		} elseif (!$lrun->isOk(true)) {
			$obj_errors = $lrun->getDataErrors();
			$obj_errors_txt = implode("<br>\n", $obj_errors);

			$sp_errors["jobRunList"] = "آخر تنفيذ :$lrun  " . $obj_errors_txt;
		}
		//else die("lastrun=".var_export($lrun,true));

		return $sp_errors;
	}
}
