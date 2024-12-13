<?php


class WorkflowPublicationAfwStructure
{
	// token separator = §
	public static function initInstance(&$obj)
	{
		if ($obj instanceof Publication) {
			$obj->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
			$obj->DISPLAY_FIELD = "name_ar";
			$obj->UNIQUE_KEY = array('module_id', 'name_ar');

			// $obj->ENABLE_DISPLAY_MODE_IN_QEDIT=true;
			$obj->ORDER_BY_FIELDS = "name_ar";

			$obj->showQeditErrors = true;
			$obj->showRetrieveErrors = true;
			$obj->general_check_errors = true;
			// $obj->after_save_edit = array("class"=>'Road',"attribute"=>'road_id', "currmod"=>'btb',"currstep"=>9);
			$obj->after_save_edit = array("mode" => "qsearch", "currmod" => 'adm', "class" => 'Publication', "submit" => true);
		} else {
			PublicationArTranslator::initData();
			PublicationEnTranslator::initData();
		}
	}


	public static $DB_STRUCTURE =
	array(
		'id' => array('SHOW' => true, 'RETRIEVE' => true, 'EDIT' => false, 'TYPE' => 'PK'),

		'module_id' => array(
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'AUDIT' => false,
			'RETRIEVE' => true,
			'EDIT' => true,
			'QEDIT' => true,
			'SIZE' => 32,
			'MAXLENGTH' => 32,
			'MIN-SIZE' => 1,
			'DEFAULT' => 1282,
			'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",
			'MANDATORY' => true,
			'UTF8' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'module',
			'ANSMODULE' => 'ums',
			'RELATION' => 'ManyToOne',
			'READONLY' => false,
			'CSS' => 'width_pct_50',
		),

		'published' => array(
			'SEARCH' => false,
			'QSEARCH' => false,
			'SHOW' => true,
			'AUDIT' => false,
			'RETRIEVE' => true,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 32,
			'MAXLENGTH' => 32,
			'MIN-SIZE' => 1,
			'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",
			'MANDATORY' => true,
			'UTF8' => false,
			'TYPE' => 'YN',
			'DEFAUT' => 'Y',
			'FORMAT' => 'ICON',
			'READONLY' => false,
			'CSS' => 'width_pct_50',
		),

		'name_ar' => array(
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'AUDIT' => false,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => true,
			'SIZE' => 128,
			'MAXLENGTH' => 128,
			'MIN-SIZE' => 5,
			'CHAR_TEMPLATE' => "ARABIC-CHARS,SPACE",
			'MANDATORY' => true,
			'UTF8' => true,
			'TYPE' => 'TEXT',
			'READONLY' => false,
			'CSS' => 'width_pct_50',
		),

		

		'name_en' => array(
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'AUDIT' => false,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => true,
			'SIZE' => 128,
			'MAXLENGTH' => 128,
			'MIN-SIZE' => 5,
			'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",
			'MANDATORY' => true,
			'UTF8' => false,
			'TYPE' => 'TEXT',
			'READONLY' => false,
			'CSS' => 'width_pct_50',
		),
		
		

		'title_ar' => array(
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'AUDIT' => false,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => true,
			'SIZE' => 64,
			'MAXLENGTH' => 64,
			'MIN-SIZE' => 1,
			'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",
			'MANDATORY' => true,
			'UTF8' => true,
			'TYPE' => 'TEXT',
			'READONLY' => false,
			'CSS' => 'width_pct_50',
		),

		'title_en' => array(
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'AUDIT' => false,
			'RETRIEVE' => true,
			'EDIT' => true,
			'QEDIT' => true,
			'SIZE' => 64,
			'MAXLENGTH' => 64,
			'MIN-SIZE' => 1,
			'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",
			'MANDATORY' => true,
			'UTF8' => false,
			'TYPE' => 'TEXT',
			'READONLY' => false,
			'CSS' => 'width_pct_50',
		),

		'summary_ar' => array(
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'AUDIT' => false,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 'AREA',
			'MAXLENGTH' => 128,
			'MIN-SIZE' => 1,
			'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",
			'MANDATORY' => true,
			'UTF8' => true,
			'TYPE' => 'TEXT',
			'READONLY' => false,
			'CSS' => 'width_pct_50',
		),

		'summary_en' => array(
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'AUDIT' => false,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 'AREA',
			'MAXLENGTH' => 128,
			'MIN-SIZE' => 1,
			'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",
			'MANDATORY' => true,
			'UTF8' => false,
			'TYPE' => 'TEXT',
			'READONLY' => false,
			'CSS' => 'width_pct_50',
		),

		'desc_ar' => array(
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'AUDIT' => false,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 'AREA',
			'MAXLENGTH' => 99999,
			'MIN-SIZE' => 1,
			'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",
			'UTF8' => true,
			'TYPE' => 'TEXT',
			'MANDATORY' => true,
			'READONLY' => false,
			'CSS' => 'width_pct_50',
		),

		'desc_en' => array(
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'AUDIT' => false,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 'AREA',
			'MAXLENGTH' => 99999,
			'MIN-SIZE' => 1,
			'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",
			'UTF8' => false,
			'TYPE' => 'TEXT',
			'MANDATORY' => true,
			'READONLY' => false,
			'CSS' => 'width_pct_50',
		),

		'publish_start_date' => array(
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'AUDIT' => false,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 10,
			'MAXLENGTH' => 10,
			'MIN-SIZE' => 1,
			'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",
			'FORMAT' => 'HIJRI_UNIT',
			'UTF8' => false,
			'TYPE' => 'DATE',
			'READONLY' => false,
			'CSS' => 'width_pct_50',
		),

		'publish_end_date' => array(
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'AUDIT' => false,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 10,
			'MAXLENGTH' => 10,
			'MIN-SIZE' => 1,
			'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",
			'FORMAT' => 'HIJRI_UNIT',
			'UTF8' => false,
			'TYPE' => 'DATE',
			'READONLY' => false,
			'CSS' => 'width_pct_50',
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
