<?php 
        class WorkflowScjobAfwStructure 
        {

			public static function initInstance(&$obj)
			{
					if ($obj instanceof Scjob) 
					{
                        $obj->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                        $obj->DISPLAY_FIELD = "job_name";
                        $obj->ORDER_BY_FIELDS = "job_code";


                        $obj->UNIQUE_KEY = array('job_code');

                        $obj->showQeditErrors = true;
                        $obj->showRetrieveErrors = true;
                        $obj->forceCheckErrors = true;

						
					}
			}

            public static $DB_STRUCTURE = array(
                'id' =>
                array(
                    'SHOW' => true,
                    'RETRIEVE' => true,
                    'EDIT' => true,
                    'TYPE' => 'PK',
                ),
                'job_code' =>
                array(
                    'SEARCH' => true,
                    'QSEARCH' => true,
                    'SHOW' => true,
                    'RETRIEVE' => true,
                    'EDIT' => true,
                    'QEDIT' => true,
                    'SIZE' => 16,
                    'MIN-SIZE' => 3,
                    'CHAR_TEMPLATE' => 'ALPHABETIC,NUMERIC,UNDERSCORE',
                    'MANDATORY' => true,
                    'UTF8' => true,
                    'TYPE' => 'TEXT',
                    'READONLY' => false,
                ),
                'job_name' =>
                array(
                    'SEARCH' => true,
                    'QSEARCH' => true,
                    'SHOW' => true,
                    'RETRIEVE' => true,
                    'EDIT' => true,
                    'QEDIT' => true,
                    'SIZE' => 64,
                    'MIN-SIZE' => 10,
                    'CHAR_TEMPLATE' => 'ARABIC-CHARS,SPACE',
                    'MANDATORY' => true,
                    'UTF8' => true,
                    'TYPE' => 'TEXT',
                    'READONLY' => false,
                ),
                'module_id' =>
                array(
                    'SHORTNAME' => 'module',
                    'SEARCH' => true,
                    'QSEARCH' => true,
                    'SHOW' => true,
                    'RETRIEVE' => true,
                    'EDIT' => true,
                    'QEDIT' => true,
                    'SIZE' => 32,
                    'MANDATORY' => false,
                    'UTF8' => false,
                    'TYPE' => 'FK',
                    'ANSWER' => 'module',
                    'ANSMODULE' => 'ums',
                    'RELATION' => 'ManyToOne',
                    'READONLY' => false,
                    'WHERE' => 'id_module_type=5 and id_module_status in (3,4)',
                ),
                'atable_id' =>
                array(
                    'SHORTNAME' => 'atable',
                    'WHERE' => 'id_module=§module_id§ and avail=\'Y\'',
                    'SEARCH' => true,
                    'QSEARCH' => false,
                    'SHOW' => true,
                    'RETRIEVE' => true,
                    'EDIT' => true,
                    'QEDIT' => false,
                    'SIZE' => 40,
                    'UTF8' => false,
                    'TYPE' => 'FK',
                    'ANSWER' => 'atable',
                    'ANSMODULE' => 'pag',
                    'RELATION' => 'ManyToOne',
                    'READONLY' => false,
                ),
                'frequency' =>
                array(
                    'SEARCH' => true,
                    'QSEARCH' => false,
                    'SHOW' => true,
                    'RETRIEVE' => true,
                    'EDIT' => true,
                    'QEDIT' => true,
                    'SIZE' => 32,
                    'MANDATORY' => true,
                    'UTF8' => false,
                    'TYPE' => 'ENUM',
                    'ANSWER' => 'FUNCTION',
                    'ANSMODULE' => 'scd',
                    'READONLY' => false,
                ),
                'frequency_params' =>
                array(
                    'SEARCH' => true,
                    'QSEARCH' => false,
                    'SHOW' => true,
                    'RETRIEVE' => false,
                    'EDIT' => true,
                    'QEDIT' => true,
                    'SIZE' => 255,
                    'CHAR_TEMPLATE' => '',
                    'UTF8' => true,
                    'TYPE' => 'TEXT',
                    'READONLY' => false,
                ),
                'jobRunList' =>
                array(
                    'SHORTNAME' => 'jobRuns',
                    'SHOW' => true,
                    'FORMAT' => 'retrieve',
                    'ICONS' => true,
                    'DELETE-ICON' => true,
                    'BUTTONS' => true,
                    'SEARCH' => true,
                    'QSEARCH' => false,
                    'RETRIEVE' => false,
                    'EDIT' => false,
                    'QEDIT' => false,
                    'SIZE' => 32,
                    'MANDATORY' => false,
                    'UTF8' => false,
                    'TYPE' => 'FK',
                    'POLE' => false,
                    'CATEGORY' => 'ITEMS',
                    'ANSWER' => 'job_run',
                    'ANSMODULE' => 'workflow',
                    'ITEM' => 'scjob_id',
                    'WHERE' => 'run_date >= §run_date_min§',
                    'ORDER_BY' => 'run_date desc, run_time desc',
                    'READONLY' => false,
                    'CAN-BE-SETTED' => true,
                ),
                'run_date_min' =>
                array(
                    'TYPE' => 'TEXT',
                    'CATEGORY' => 'FORMULA',
                    'SHOW' => false,
                    'RETRIEVE' => false,
                ),
                'last_run_date_time' =>
                array(
                    'TYPE' => 'TEXT',
                    'CATEGORY' => 'FORMULA',
                    'SHOW' => true,
                    'RETRIEVE' => true,
                ),
                'last_run_records' =>
                array(
                    'TYPE' => 'TEXT',
                    'CATEGORY' => 'FORMULA',
                    'SHOW' => true,
                    'RETRIEVE' => true,
                ),
                'active' =>
                array(
                    'SHOW' => true,
                    'RETRIEVE' => true,
                    'EDIT' => true,
                    'QEDIT' => false,
                    'DEFAULT' => 'Y',
                    'TYPE' => 'YN',
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
}