<?php 
        class WorkflowWorkflowFileAfwStructure
        {

			public static function initInstance(&$obj)
			{
					if ($obj instanceof WorkflowFile) 
					{
						$obj->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 0;
						$obj->DISPLAY_FIELD = "afile_name";
						$obj->ORDER_BY_FIELDS = "created_at desc";
						$obj->UNIQUE_KEY = array('afile_name');
						$obj->public_display = true;
						$obj->IS_LOOKUP = true;

						$obj->showQeditErrors = true;
						//$this->qedit_minibox = true;
						$obj->ENABLE_DISPLAY_MODE_IN_QEDIT = true;	
					}
			}

                public static $DB_STRUCTURE = array(

                        
			'id' => array('SHOW' => true,  'RETRIEVE' => false,  'EDIT' => true,  
				'TYPE' => 'PK',  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'original_name' => array('SHOW' => true,  'RETRIEVE' => true,  'EDIT' => true,  
				'TYPE' => 'TEXT',  'UTF8' => true,  'SHORTNAME' => 'original',  'SIZE' => 64,  'READONLY' => true,  'SEARCH' => true,  'QSEARCH' => true,  'QEDIT' => false,  'SEARCH-BY-ONE' => true,  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'afile_name' => array('SHOW' => true,  'RETRIEVE' => true,  'EDIT' => true,  
				'TYPE' => 'TEXT',  'UTF8' => true,  'SHORTNAME' => 'name',  'SIZE' => 64,  'SEARCH' => true,  'QSEARCH' => true,  'SEARCH-BY-ONE' => true,  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'afile_ext' => array('SHOW' => true,  'RETRIEVE' => false,  'EDIT' => true,  'QEDIT' => false,  
				'TYPE' => 'TEXT',  'UTF8' => true,  'SHORTNAME' => 'ext',  'SIZE' => 5,  'READONLY' => true,  'SEARCH' => true,  'QSEARCH' => true,  'NO-COTE' => true,  'SEARCH-BY-ONE' => true,  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'doc_type_id' => array('IMPORTANT' => 'IN',  'SEARCH' => true,  'SHOW' => true,  'RETRIEVE' => true,  'EDIT' => true,  'QEDIT' => true,  'SIZE' => 40,  'SEARCH-ADMIN' => true,  'SHOW-ADMIN' => true,  'EDIT-ADMIN' => true,  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'doc_type',  'ANSMODULE' => 'ums',  
				'WHERE' => "id in (§module_config_token_file_types§) and concat(',',valid_ext,',') like '%,§afile_ext§,%'", 
				 'DEFAUT' => 0,  'QSEARCH' => true,  'SEARCH-BY-ONE' => true,  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'afile_type' => array('SHOW' => true,  'RETRIEVE' => true,  'EDIT' => true,  'QEDIT' => false,  
				'TYPE' => 'TEXT',  'UTF8' => true,  'SHORTNAME' => 'type',  'SIZE' => 16,  'READONLY' => true,  'SEARCH' => true,  'QSEARCH' => true,  'SEARCH-BY-ONE' => true,  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'picture' => array('RETRIEVE' => false,  'EDIT' => true,  'QEDIT' => false,  
				'TYPE' => 'YN',  'DEFAUT' => 'N',  'READONLY' => true,  'SEARCH-BY-ONE' => '',  'DISPLAY' => '',  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

		'small_picture' => array(
				'CATEGORY' => 'FORMULA',  'RETRIEVE' => false,  'EDIT' => true,  'QEDIT' => false,  
				'TYPE' => 'YN',  'DEFAUT' => 'N',  'READONLY' => true,  'SEARCH-BY-ONE' => '',  'DISPLAY' => '',  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

		'big_picture' => array(
				'CATEGORY' => 'FORMULA',  'RETRIEVE' => false,  'EDIT' => true,  'QEDIT' => false,  
				'TYPE' => 'YN',  'DEFAUT' => 'N',  'READONLY' => true,  'SEARCH-BY-ONE' => '',  'DISPLAY' => '',  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

		'embed' => array(
				'CATEGORY' => 'FORMULA',  'RETRIEVE' => false,  'EDIT' => true,  'QEDIT' => false,  
				'TYPE' => 'YN',  'DEFAUT' => 'N',  'READONLY' => true,  'SEARCH-BY-ONE' => '',  'DISPLAY' => '',  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'afile_size' => array('SHOW' => true,  'RETRIEVE' => true,  'EDIT' => true,  'QEDIT' => false,  
				'TYPE' => 'INT',  'SHORTNAME' => 'size',  'READONLY' => true,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

		'afile_date' => array(
				'TYPE' => 'DATE',  
				'CATEGORY' => 'FORMULA',  'EDIT' => true,  'QEDIT' => false,  'READONLY' => true,  'SHOW' => true,  'SEARCH' => false,  'FORMAT' => 'CONVERT_NASRANI_SIMPLE',  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

		'afile_time' => array(
				'TYPE' => 'TIME',  
				'CATEGORY' => 'FORMULA',  'EDIT' => true,  'QEDIT' => false,  'READONLY' => true,  'SHOW' => true,  'SEARCH' => false,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			/*'owner_id' => array('SEARCH' => true,  'QSEARCH' => true,  'SHOW' => true,  'RETRIEVE' => true,  'EDIT' => true,  'QEDIT' => true,  'SIZE' => 40,  'SEARCH-ADMIN' => true,  'SHOW-ADMIN' => true,  'EDIT-ADMIN' => true,  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'auser',  'ANSMODULE' => 'ums',  'DEFAUT' => 0,  'DISTINCT-FOR-LIST' => true,  'READONLY' => true,  'SEARCH-BY-ONE' => true,  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'stakeholder_id' => array('IMPORTANT' => 'IN',  'SEARCH' => true,  'SHOW' => true,  'RETRIEVE' => false,  'QEDIT' => false,  'EDIT' => true,  'SIZE' => 40,  'SEARCH-ADMIN' => true,  'SHOW-ADMIN' => true,  'EDIT-ADMIN' => true,  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'orgunit',  'ANSMODULE' => 'hrm',  'DEFAUT' => 0,  'READONLY' => true,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),*/

		'preview' => array(
				'TYPE' => 'TEXT',  
				'CATEGORY' => 'FORMULA',  'SHOW' => true,  'RETRIEVE' => false,  'EDIT' => true,  'QEDIT' => false,  'READONLY' => true,  'SIZE' => 128,  'RO_DIV_CLASS' => 'preview_file',  'EAGER' => false,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

		'file_path' => array(
				'TYPE' => 'TEXT',  
				'CATEGORY' => 'FORMULA',  'SIZE' => 128,  'EAGER' => false,  'SEARCH-BY-ONE' => '',  'DISPLAY' => '',  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

		'pic_view' => array(
				'TYPE' => 'TEXT',  
				'CATEGORY' => 'FORMULA',  'SHOW' => true,  'RETRIEVE' => true, 'EDIT-HIDDEN' => true,   'EDIT' => true,  'QEDIT' => true,  'READONLY' => true,  'SIZE' => 128,  'RO_DIV_CLASS' => 'preview_file',  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

		'download' => array(
				'TYPE' => 'TEXT',  
				'CATEGORY' => 'FORMULA',  'SHOW' => true,  'RETRIEVE' => true,  'EDIT' => true,  'QEDIT' => false,  'READONLY' => true,  'RO_DIV_CLASS' => 'empty_div',  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

		'download_light' => array(
				'TYPE' => 'TEXT',  
				'CATEGORY' => 'FORMULA',  'SHOW' => true,  'RETRIEVE' => true,  'EDIT' => true,  'QEDIT' => false,  'READONLY' => true,  'RO_DIV_CLASS' => 'empty_div',  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

		'is_ok' => array(
				'TYPE' => 'TEXT',  
				'CATEGORY' => 'FORMULA',  'SHOW' => true,  'RETRIEVE' => true,  'EDIT' => false,  'QEDIT' => false,  'READONLY' => true,  'NO-ERROR-CHECK' => true,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'active' => array('SHOW' => true,  'RETRIEVE' => true,  'EDIT' => true, 'QEDIT' => true, 'DEFAUT' => 'Y',  
                'TYPE' => 'YN',    'FORMAT' => 'icon',  'STEP' => 99,  
                'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
                'CSS' => 'width_pct_25',),

        'created_by' => array('SHOW-ADMIN' => true,  'RETRIEVE' => false,  'EDIT' => false, 'QEDIT' => false,  
                'TYPE' => 'FK',  'ANSWER' => 'auser',  'ANSMODULE' => 'ums',    'DISPLAY' => '',  'STEP' => 99,  
                'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
                'CSS' => 'width_pct_100',),

        'created_at' => array('SHOW-ADMIN' => true,  'RETRIEVE' => false,  'EDIT' => false, 'QEDIT' => false,  
                'TYPE' => 'GDAT',    'DISPLAY' => '',  'STEP' => 99,  
                'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
                'CSS' => 'width_pct_100',),

        'updated_by' => array('SHOW-ADMIN' => true,  'RETRIEVE' => false,  'EDIT' => false, 'QEDIT' => false,  
                'TYPE' => 'FK',  'ANSWER' => 'auser',  'ANSMODULE' => 'ums',    'DISPLAY' => '',  'STEP' => 99,  
                'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
                'CSS' => 'width_pct_100',),

        'updated_at' => array('SHOW-ADMIN' => true,  'RETRIEVE' => false,  'EDIT' => false, 'QEDIT' => false,  
                'TYPE' => 'GDAT',    'DISPLAY' => '',  'STEP' => 99,  
                'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
                'CSS' => 'width_pct_100',),

        'validated_by' => array('SHOW-ADMIN' => true,  'RETRIEVE' => false,  'EDIT' => false, 'QEDIT' => false,  
                'TYPE' => 'FK',  'ANSWER' => 'auser',  'ANSMODULE' => 'ums',    'DISPLAY' => '',  'STEP' => 99,  
                'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
                'CSS' => 'width_pct_100',),

        'validated_at' => array('SHOW-ADMIN' => true,  'RETRIEVE' => false,  'EDIT' => false, 'QEDIT' => false,  
                'TYPE' => 'GDAT',    'DISPLAY' => '',  'STEP' => 99,  
                'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
                'CSS' => 'width_pct_100',),

        


        'version'                  => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 
                                        'QEDIT' => false, 'TYPE' => 'INT', 'FGROUP' => 'tech_fields'),

        'update_groups_mfk'             => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 
                                        'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields'),

        'delete_groups_mfk'             => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 
                                        'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields'),

        'display_groups_mfk'            => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 
                                        'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields'),

        'sci_id'                        => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 
                                        'TYPE' => 'FK', 'ANSWER' => 'scenario_item', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),

        'tech_notes' 	                => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'TYPE' => 'TEXT', 'CATEGORY' => 'FORMULA', 'SHOW-ADMIN' => true,  'QEDIT' => false, 
                                        'TOKEN_SEP'=>'§', 'READONLY'=>true, 'NO-ERROR-CHECK'=>true, 'FGROUP' => 'tech_fields'),				

                ); 
        } 
?>