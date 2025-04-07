<?php
class JobRun extends AFWObject
{

        public static $MY_ATABLE_ID = 3608;
        // إجراء إحصائيات حول تنفيذات المهام الآلية 
        public static $BF_STATS_JOB_RUN = 103887;
        // إدارة تنفيذات المهام الآلية 
        public static $BF_QEDIT_JOB_RUN = 103882;
        // إنشاء تنفيذ مهمة آلية 
        public static $BF_EDIT_JOB_RUN = 103881;
        // الاستعلام عن تنفيذ مهمة آلية 
        public static $BF_QSEARCH_JOB_RUN = 103886;
        // البحث في تنفيذات المهام الآلية 
        public static $BF_SEARCH_JOB_RUN = 103885;
        // عرض تفاصيل تنفيذ مهمة آلية 
        public static $BF_DISPLAY_JOB_RUN = 103884;
        // مسح تنفيذ مهمة آلية 
        public static $BF_DELETE_JOB_RUN = 103883;


        public static $DB_STRUCTURE = array(
                'id' =>
                array(
                        'SHOW' => true,
                        'RETRIEVE' => true,
                        'EDIT' => true,
                        'TYPE' => 'PK',
                ),
                'scjob_id' =>
                array(
                        'SHORTNAME' => 'job',
                        'SEARCH' => true,
                        'QSEARCH' => false,
                        'SHOW' => true,
                        'RETRIEVE' => false,
                        'EDIT' => true,
                        'QEDIT' => false,
                        'SIZE' => 32,
                        'MANDATORY' => true,
                        'UTF8' => false,
                        'TYPE' => 'FK',
                        'ANSWER' => 'scjob',
                        'ANSMODULE' => 'atm',
                        'RELATION' => 'OneToMany',
                        'READONLY' => true,
                ),
                'run_date' =>
                array(
                        'SEARCH' => true,
                        'QSEARCH' => false,
                        'SHOW' => true,
                        'RETRIEVE' => true,
                        'EDIT' => true,
                        'QEDIT' => false,
                        'SIZE' => 10,
                        'MANDATORY' => true,
                        'UTF8' => false,
                        'TYPE' => 'DATE',
                        'FORMAT' => 'HIJRI_UNIT',
                        'READONLY' => true,
                ),
                'run_time' =>
                array(
                        'SEARCH' => true,
                        'QSEARCH' => false,
                        'SHOW' => true,
                        'RETRIEVE' => true,
                        'EDIT' => true,
                        'QEDIT' => false,
                        'SIZE' => 8,
                        'MANDATORY' => true,
                        'UTF8' => false,
                        'TYPE' => 'TIME',
                        'READONLY' => true,
                ),
                'run_end_date' =>
                array(
                        'SEARCH' => true,
                        'QSEARCH' => false,
                        'SHOW' => true,
                        'RETRIEVE' => true,
                        'EDIT' => true,
                        'QEDIT' => false,
                        'SIZE' => 10,
                        'UTF8' => false,
                        'TYPE' => 'DATE',
                        'FORMAT' => 'HIJRI_UNIT',
                        'READONLY' => true,
                ),
                'run_end_time' =>
                array(
                        'SEARCH' => true,
                        'QSEARCH' => false,
                        'SHOW' => true,
                        'RETRIEVE' => true,
                        'EDIT' => true,
                        'QEDIT' => false,
                        'SIZE' => 8,
                        'UTF8' => false,
                        'TYPE' => 'TIME',
                        'READONLY' => true,
                ),
                'errors_nb' =>
                array(
                        'SEARCH' => true,
                        'QSEARCH' => false,
                        'SHOW' => true,
                        'RETRIEVE' => true,
                        'EDIT' => true,
                        'QEDIT' => false,
                        'SIZE' => 32,
                        'UTF8' => false,
                        'TYPE' => 'INT',
                        'READONLY' => true,
                        'FORMAT' => 'CSSED',
                        'CSSED_TO_CLASS' => 'nb_error',
                ),
                'warning_nb' =>
                array(
                        'SEARCH' => true,
                        'QSEARCH' => false,
                        'SHOW' => true,
                        'RETRIEVE' => true,
                        'EDIT' => true,
                        'QEDIT' => false,
                        'SIZE' => 32,
                        'UTF8' => false,
                        'TYPE' => 'INT',
                        'READONLY' => true,
                        'FORMAT' => 'CSSED',
                        'CSSED_TO_CLASS' => 'nb_warning',
                ),
                'notification_nb' =>
                array(
                        'SEARCH' => true,
                        'QSEARCH' => false,
                        'SHOW' => true,
                        'RETRIEVE' => true,
                        'EDIT' => true,
                        'QEDIT' => false,
                        'SIZE' => 32,
                        'UTF8' => false,
                        'TYPE' => 'INT',
                        'READONLY' => true,
                        'FORMAT' => 'CSSED',
                        'CSSED_TO_CLASS' => 'nb_ok',
                ),
                'jobRunResultList' =>
                array(
                        'SHORTNAME' => 'jobRunResults',
                        'SHOW' => true,
                        'FORMAT' => 'crossed',
                        'CROSS_COL' => 'item',
                        'CROSSED_FIELD_COL' => 'result_code',
                        'CROSSED_VALUE_COL' => 'result_value',
                        'ICONS' => true,
                        'DELETE-ICON' => true,
                        'BUTTONS' => true,
                        'SEARCH' => true,
                        'QSEARCH' => false,
                        'RETRIEVE' => false,
                        'EDIT' => true,
                        'QEDIT' => false,
                        'SIZE' => 32,
                        'MANDATORY' => false,
                        'UTF8' => false,
                        'TYPE' => 'FK',
                        'CATEGORY' => 'ITEMS',
                        'ANSWER' => 'job_run_result',
                        'ANSMODULE' => 'atm',
                        'ITEM' => 'job_run_id',
                        'READONLY' => true,
                        'CAN-BE-SETTED' => true,
                ),
                'log_path' =>
                array(
                        'SEARCH' => true,
                        'QSEARCH' => true,
                        'SHOW' => true,
                        'RETRIEVE' => false,
                        'EDIT' => false,
                        'QEDIT' => false,
                        'SIZE' => 255,
                        'CHAR_TEMPLATE' => '',
                        'UTF8' => true,
                        'TYPE' => 'TEXT',
                        'READONLY' => true,
                ),
                'comments' =>
                array(
                        'SEARCH' => true,
                        'QSEARCH' => false,
                        'SHOW' => true,
                        'RETRIEVE' => true,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'SIZE' => 255,
                        'CHAR_TEMPLATE' => 'ALL',
                        'UTF8' => true,
                        'TYPE' => 'TEXT',
                        'READONLY' => true,
                ),
                'log_view' =>
                array(
                        'TYPE' => 'TEXT',
                        'SIZE' => 'AREA',
                        'FORMAT' => 'PRE',
                        'CATEGORY' => 'FORMULA',
                        'SHOW' => true,
                        'RETRIEVE' => false,
                ),
                'creation_user_id' =>
                array(
                        'SHOW-ADMIN' => true,
                        'RETRIEVE' => false,
                        'EDIT' => false,
                        'TYPE' => 'FK',
                        'ANSWER' => 'auser',
                        'ANSMODULE' => 'ums',
                ),
                'creation_date' =>
                array(
                        'SHOW-ADMIN' => true,
                        'RETRIEVE' => false,
                        'EDIT' => false,
                        'TYPE' => 'DATETIME',
                ),
                'update_user_id' =>
                array(
                        'SHOW-ADMIN' => true,
                        'RETRIEVE' => false,
                        'EDIT' => false,
                        'TYPE' => 'FK',
                        'ANSWER' => 'auser',
                        'ANSMODULE' => 'ums',
                ),
                'update_date' =>
                array(
                        'SHOW-ADMIN' => true,
                        'RETRIEVE' => false,
                        'EDIT' => false,
                        'TYPE' => 'DATETIME',
                ),
                'validation_user_id' =>
                array(
                        'SHOW-ADMIN' => true,
                        'RETRIEVE' => false,
                        'EDIT' => false,
                        'TYPE' => 'FK',
                        'ANSWER' => 'auser',
                        'ANSMODULE' => 'ums',
                ),
                'validation_date' =>
                array(
                        'SHOW-ADMIN' => true,
                        'RETRIEVE' => false,
                        'EDIT' => false,
                        'TYPE' => 'DATETIME',
                ),
                'active' =>
                array(
                        'SHOW-ADMIN' => true,
                        'RETRIEVE' => false,
                        'EDIT' => false,
                        'QEDIT' => false,
                        'DEFAULT' => 'Y',
                        'TYPE' => 'YN',
                ),
                'version' =>
                array(
                        'SHOW-ADMIN' => true,
                        'RETRIEVE' => false,
                        'EDIT' => false,
                        'TYPE' => 'INT',
                ),
                'update_groups_mfk' =>
                array(
                        'SHOW-ADMIN' => true,
                        'RETRIEVE' => false,
                        'EDIT' => false,
                        'ANSWER' => 'ugroup',
                        'ANSMODULE' => 'ums',
                        'TYPE' => 'MFK',
                ),
                'delete_groups_mfk' =>
                array(
                        'SHOW-ADMIN' => true,
                        'RETRIEVE' => false,
                        'EDIT' => false,
                        'ANSWER' => 'ugroup',
                        'ANSMODULE' => 'ums',
                        'TYPE' => 'MFK',
                ),
                'display_groups_mfk' =>
                array(
                        'SHOW-ADMIN' => true,
                        'RETRIEVE' => false,
                        'EDIT' => false,
                        'ANSWER' => 'ugroup',
                        'ANSMODULE' => 'ums',
                        'TYPE' => 'MFK',
                ),
                'sci_id' =>
                array(
                        'SHOW-ADMIN' => true,
                        'RETRIEVE' => false,
                        'EDIT' => false,
                        'TYPE' => 'FK',
                        'ANSWER' => 'scenario_item',
                        'ANSMODULE' => 'pag',
                ),
                'tech_notes' =>
                array(
                        'TYPE' => 'TEXT',
                        'CATEGORY' => 'FORMULA',
                        'SHOW-ADMIN' => true,
                        'STEP' => 'all',
                        'TOKEN_SEP' => '§',
                        'READONLY' => true,
                        'NO-ERROR-CHECK' => true,
                ),
        );

        public function __construct()
        {
                parent::__construct("job_run", "id", "atm");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "";
                $this->ORDER_BY_FIELDS = "scjob_id, run_date desc, run_time desc";


                $this->UNIQUE_KEY = array('scjob_id', 'run_date', 'run_time');

                $this->showQeditErrors = true;
                $this->showRetrieveErrors = true;
        }

        public static function loadById($id)
        {
                $obj = new JobRun();
                $obj->select_visibilite_horizontale();
                if ($obj->load($id)) {
                        return $obj;
                } else return null;
        }



        public static function loadByMainIndex($scjob_id, $run_date, $run_time, $create_obj_if_not_found = false)
        {
                $obj = new JobRun();
                if (!$scjob_id) $obj->_error("loadByMainIndex : scjob_id is mandatory field");
                if (!$run_date) $obj->_error("loadByMainIndex : run_date is mandatory field");
                if (!$run_time) $obj->_error("loadByMainIndex : run_time is mandatory field");


                $obj->select("scjob_id", $scjob_id);
                $obj->select("run_date", $run_date);
                $obj->select("run_time", $run_time);

                if ($obj->load()) {
                        if ($create_obj_if_not_found) $obj->activate();
                        return $obj;
                } elseif ($create_obj_if_not_found) {
                        $obj->set("scjob_id", $scjob_id);
                        $obj->set("run_date", $run_date);
                        $obj->set("run_time", $run_time);

                        $obj->insert();
                        $obj->is_new = true;
                        return $obj;
                } else return null;
        }


        public function getDisplay($lang = "ar")
        {

                $data = array();
                $link = array();


                list($data[0], $link[0]) = $this->displayAttribute("scjob_id", false, $lang);
                list($data[1], $link[1]) = $this->displayAttribute("run_date", false, $lang);
                list($data[2], $link[2]) = $this->displayAttribute("run_time", false, $lang);


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
                                // atm.job_run_result-تعريف تنفيذ مهمة آلية	job_run_id  أنا تفاصيل لها-OneToMany
                                $this->execQuery("delete from ${server_db_prefix}atm.job_run_result where job_run_id = '$id' ");


                                // FK not part of me - replaceable 



                                // MFK

                        } else {
                                // FK on me 
                                // atm.job_run_result-تعريف تنفيذ مهمة آلية	job_run_id  أنا تفاصيل لها-OneToMany
                                $this->execQuery("update ${server_db_prefix}atm.job_run_result set job_run_id='$id_replace' where job_run_id='$id' ");


                                // MFK


                        }
                        return true;
                }
        }

        public function setNewItemValue($item, $result_code, $result_value)
        {
                require_once("job_run_result.php");
                $jrun_res = JobRunResult::loadByMainIndex($this->getId(), $item, $result_code, $create_obj_if_not_found = true);
                $jrun_res->set("result_value", $result_value);

                $jrun_res->commit();

                return $jrun_res;
        }

        public function endOfRun($count_errors, $count_warnings, $count_infos)
        {
                global $hijri_current_date;
                date_default_timezone_set("Asia/Riyadh");
                $this->set("run_end_date", $hijri_current_date);
                $this->set("run_end_time", date("H:i:s"));
                $this->set("errors_nb", $count_errors);
                $this->set("warning_nb", $count_warnings);
                $this->set("notification_nb", $count_infos);


                $this->commit();
        }

        public function getFormuleResult($attribute, $what = 'value')
        {
                global $server_db_prefix, $objme, $images;

                $file_dir_name = dirname(__FILE__);

                switch ($attribute) {
                        case "log_view":
                                $file_path = $this->getVal("log_path");
                                require_once("/var/www/php_batch/common/hzm_colors.php");
                                $lines = AfwFilesystem::read($file_path);

                                $lines_arr = explode("\n", $lines);
                                $lines_html_arr = array();
                                foreach ($lines_arr as $colored_line) {
                                        $lines_html_arr[] = Colors::coloredStringToHtml($colored_line);
                                }

                                return implode("\n", $lines_html_arr);

                                break;
                }
        }

        protected function getSpecificDataErrors($lang="ar",$show_val=true,$step="all",$erroned_attribute=null,$stop_on_first_error=false, $start_step=null, $end_step=null)
        {
                date_default_timezone_set("Asia/Riyadh");
                $sp_errors = array();

                $job = $this->hetJob();
                if (!$job) $sp_errors["scjob_id"] = "خطأ حرج : المهمة الآلية غير محددة";

                $run_date = $this->getVal("run_date");
                $run_time = $this->getVal("run_time");
                if (!$run_time) $run_time = "00:00:00";

                if (!$run_date) {
                        $sp_errors["run_date"] = "خطأ حرج :تاريخ تنفيذ  المهمة الآلية غير محدد";
                } else {
                        $run_start_datetime_greg = AfwDateHelper::hijriToGreg($run_date) . " $run_time";

                        $run_end_date = $this->getVal("run_end_date");
                        $run_end_time = $this->getVal("run_end_time");
                        if (!$run_end_time) $run_end_time = "00:00:00";

                        if ($run_end_date) {
                                $run_end_datetime_greg = AfwDateHelper::hijriToGreg($run_end_date) . " $run_end_time";
                        } else {
                                $run_end_datetime_greg = date("Y-m-d H:i:s");
                        }


                        $maxtime = $job->calcMax_time_of_exec();
                        $timeof_exec = diff_datetime_in_sec($run_end_datetime_greg, $run_start_datetime_greg) / 3600.0;
                        if ($timeof_exec > $maxtime) {
                                $sp_errors["run_end_time"] = "مدة تنفيذ المهمة تجاوزت الحد الأقصى";
                                /*$sp_errors["run_end_time"] .= "<br><pre class='technical_dev'>
                         ($run_end_datetime_greg - $run_start_datetime_greg) / 3600 = $timeof_exec > $maxtime\n
                         note : $run_start_datetime_greg =  hijri_to_greg($run_date) $run_time
                         </pre>";*/
                        }
                }








                return $sp_errors;
        }
}
