<?php


class WorkflowJobRunAfwStructure
{
	// token separator = §
	public static function initInstance(&$obj)
	{
		if ($obj instanceof JobRun) {			    
			$obj->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
			$obj->DISPLAY_FIELD = "";

			// $obj->ENABLE_DISPLAY_MODE_IN_QEDIT=true;
			$obj->ORDER_BY_FIELDS = "scjob_id, run_date desc, run_time desc";



			$obj->UNIQUE_KEY = array('scjob_id', 'run_date', 'run_time');

			$obj->showQeditErrors = true;
			$obj->showRetrieveErrors = true;
			$obj->general_check_errors = true;
			// $obj->after_save_edit = array("class"=>'Road',"attribute"=>'road_id', "currmod"=>'btb',"currstep"=>9);
			$obj->after_save_edit = array("mode" => "qsearch", "currmod" => 'workflow', "class" => 'JobRun', "submit" => true);
		} else {
			JobRunArTranslator::initData();
			JobRunEnTranslator::initData();
		}
	}


	public static $DB_STRUCTURE =
	array(
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
			'ANSMODULE' => 'workflow',
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
			'ANSMODULE' => 'workflow',
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
		


		'created_by'         => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, "TECH_FIELDS-RETRIEVE" => true, 'RETRIEVE' => false,  'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),
		'created_at'         => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, "TECH_FIELDS-RETRIEVE" => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'DATETIME', 'FGROUP' => 'tech_fields'),
		'updated_by'         => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, "TECH_FIELDS-RETRIEVE" => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),
		'updated_at'         => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, "TECH_FIELDS-RETRIEVE" => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'DATETIME', 'FGROUP' => 'tech_fields'),
		'validated_by'       => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),
		'validated_at'       => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'DATETIME', 'FGROUP' => 'tech_fields'),
		'active'             => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'EDIT' => false, 'QEDIT' => false, "DEFAULT" => 'Y', 'TYPE' => 'YN', 'FGROUP' => 'tech_fields'),
		'version'            => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'INT', 'FGROUP' => 'tech_fields'),
		'draft'             => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'EDIT' => false, 'QEDIT' => false, "DEFAULT" => 'Y', 'TYPE' => 'YN', 'FGROUP' => 'tech_fields'),
		'update_groups_mfk' => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields'),
		'delete_groups_mfk' => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields'),
		'display_groups_mfk' => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields'),
		'sci_id'            => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'scenario_item', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),
		'tech_notes' 	      => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'TYPE' => 'TEXT', 'CATEGORY' => 'FORMULA', "SHOW-ADMIN" => true, 'TOKEN_SEP' => "§", 'READONLY' => true, "NO-ERROR-CHECK" => true, 'FGROUP' => 'tech_fields'),
	);
}
    


// errors 
