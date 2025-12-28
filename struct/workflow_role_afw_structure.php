<?php
class WorkflowWorkflowRoleAfwStructure
{

        public static function initInstance(&$obj)
        {
                if ($obj instanceof WorkflowRole) {
                        $obj->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 3;
                        $obj->DISPLAY_FIELD = "role_name_ar";
                        // $obj->ORDER_BY_FIELDS = "xxxx, yyyy";
                        //$obj->UNIQUE_KEY = array('role_category_enum','role_name_ar','role_name_en');
                        // $obj->public_display = true;
                        // $obj->IS_LOOKUP = true;

                        $obj->UNIQUE_KEY = array('workflow_module_id', 'lookup_code');
                        $obj->showQeditErrors = true;
                        $obj->showRetrieveErrors = true;
                        $obj->general_check_errors = true;
                        $obj->editByStep = true;
                        $obj->editNbSteps = 3;
                        // $obj->after_save_edit = array("class"=>'aconditionOriginType',"attribute"=>'acondition_origin_type_id', "currmod"=>'workflow',"currstep"=>1);
                        $obj->after_save_edit = array("mode" => "qsearch", "currmod" => 'workflow', "class" => 'WorkflowRole', "submit" => true);
                } else {
                        WorkflowRoleArTranslator::initData();
                        WorkflowRoleEnTranslator::initData();
                }
        }


        public static $DB_STRUCTURE = array(
                'id' => array(
                        'SHOW' => false,
                        'RETRIEVE' => true,
                        'EDIT' => false,
                        'TYPE' => 'PK',
                        'DISPLAY' => true,
                        'STEP' => 1,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_25',
                ),

                'workflow_module_id' => array(
                        'STEP' => 1,
                        'SHORTNAME' => 'module',
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
                        'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",
                        'MANDATORY' => true,
                        'UTF8' => false,
                        'TYPE' => 'FK',
                        'ANSWER' => 'workflow_module',
                        'ANSMODULE' => 'workflow',
                        'RELATION' => 'ManyToOne',
                        'READONLY' => true,
                        'DNA' => true,
                        'CSS' => 'width_pct_75',
                ),

                'lookup_code' => array(
                        'TYPE' => 'TEXT',
                        'SHOW' => true,
                        'RETRIEVE' => true,
                        'EDIT' => true,
                        'SIZE' => 64,
                        'QEDIT' => true,
                        'SHORTNAME' => 'code',
                        'SEARCH-BY-ONE' => '',
                        'DISPLAY' => true,    
                        'MANDATORY' => true,                    
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_25',
                ),



                'role_name_ar' => array(
                        'IMPORTANT' => 'IN',
                        'SEARCH' => true,
                        'QSEARCH' => true,
                        'SHOW' => true,
                        'RETRIEVE-AR' => true,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'SIZE' => '100',
                        'MAXLENGTH' => '100',
                        'UTF8' => true,
                        'TYPE' => 'TEXT',
                        'DISPLAY' => true,
                        'STEP' => 2,
                        'MANDATORY' => true,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_50',
                ),



                'role_name_en' => array(
                        'IMPORTANT' => 'IN',
                        'SEARCH' => true,
                        'QSEARCH' => true,
                        'SHOW' => true,
                        'RETRIEVE-EN' => true,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'SIZE' => '100',
                        'MAXLENGTH' => '100',
                        'UTF8' => false,
                        'TYPE' => 'TEXT',
                        'DISPLAY' => true,
                        'STEP' => 2,
                        'MANDATORY' => true,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_50',
                ),



                'role_description_ar' => array(
                        'IMPORTANT' => 'IN',
                        'SEARCH' => true,
                        'QSEARCH' => true,
                        'SHOW' => true,
                        'RETRIEVE-AR' => true,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'SIZE' => '100',
                        'MAXLENGTH' => '100',
                        'UTF8' => true,
                        'TYPE' => 'TEXT',
                        'DISPLAY' => true,
                        'STEP' => 2,
                        'MANDATORY' => false,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_100',
                ),



                'role_description_en' => array(
                        'IMPORTANT' => 'IN',
                        'SEARCH' => true,
                        'QSEARCH' => true,
                        'SHOW' => true,
                        'RETRIEVE-EN' => true,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'SIZE' => '100',
                        'MAXLENGTH' => '100',
                        'UTF8' => false,
                        'TYPE' => 'TEXT',
                        'DISPLAY' => true,
                        'STEP' => 2,
                        'MANDATORY' => false,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_100',
                ),

                'role_category_enum' => array(
                        'IMPORTANT' => 'IN',
                        'SEARCH' => true,
                        'SHOW' => true,
                        'RETRIEVE' => true,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'QSEARCH' => true,
                        'SHOW-ADMIN' => true,
                        'EDIT-ADMIN' => true,
                        'UTF8' => false,
                        'TYPE' => 'ENUM',
                        'ANSWER' => 'FUNCTION',
                        'SIZE' => 40,
                        'DEFAUT' => 0,
                        'DISPLAY' => true,
                        'STEP' => 2,
                        'MANDATORY' => true,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_25',
                ),

                'active' => array(
                        'SHOW' => true,
                        'RETRIEVE' => true,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'DEFAUT' => 'Y',
                        'TYPE' => 'YN',
                        'FORMAT' => 'icon',
                        'STEP' => 2,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_25',
                ),

                

                                'domain1_enum' => array(
                                        'TYPE' => 'ENUM', 'FUNCTION_COL_NAME' => 'domain_enum',
                                        'CATEGORY' => 'SHORTCUT', 'SHORTCUT'=>"workflow_module_id.domain1_enum",
                                        'SHOW' => true,
                                        'RETRIEVE' => false,
                                        'EDIT' => true,
                                        'QEDIT' => true,
                                        'WHERE' => "",
                                        'SEARCH-BY-ONE' => true,
                                        'SEARCH' => true,
                                        'QSEARCH' => true,
                                        'CSS' => 'width_pct_50',
                                        'STEP' => 99,
                                        'DISPLAY' => true,
                                        'DISPLAY-UGROUPS' => '',
                                        'EDIT-UGROUPS' => '',
                                ),

                                'domain2_enum' => array(
                                        'TYPE' => 'ENUM', 'FUNCTION_COL_NAME' => 'domain_enum',
                                        'CATEGORY' => 'SHORTCUT', 'SHORTCUT'=>"workflow_module_id.domain2_enum",
                                        'SHOW' => true,
                                        'RETRIEVE' => false,
                                        'EDIT' => true,
                                        'QEDIT' => true,
                                        'WHERE' => "",
                                        'SEARCH-BY-ONE' => true,
                                        'SEARCH' => true,
                                        'QSEARCH' => true,
                                        'CSS' => 'width_pct_50',
                                        'STEP' => 99,
                                        'DISPLAY' => true,
                                        'DISPLAY-UGROUPS' => '',
                                        'EDIT-UGROUPS' => '',
                                ),

                                'domain3_enum' => array(
                                        'TYPE' => 'ENUM', 'FUNCTION_COL_NAME' => 'domain_enum',
                                        'CATEGORY' => 'SHORTCUT', 'SHORTCUT'=>"workflow_module_id.domain3_enum",
                                        'SHOW' => true,
                                        'RETRIEVE' => false,
                                        'EDIT' => true,
                                        'QEDIT' => true,
                                        'WHERE' => "",
                                        'SEARCH-BY-ONE' => true,
                                        'SEARCH' => true,
                                        'QSEARCH' => true,
                                        'CSS' => 'width_pct_50',
                                        'STEP' => 99,
                                        'DISPLAY' => true,
                                        'DISPLAY-UGROUPS' => '',
                                        'EDIT-UGROUPS' => '',
                                ),


                                'domain4_enum' => array(
                                        'TYPE' => 'ENUM', 'FUNCTION_COL_NAME' => 'domain_enum',
                                        'CATEGORY' => 'SHORTCUT', 'SHORTCUT'=>"workflow_module_id.domain4_enum",
                                        'SHOW' => true,
                                        'RETRIEVE' => false,
                                        'EDIT' => true,
                                        'QEDIT' => true,
                                        'WHERE' => "",
                                        'SEARCH-BY-ONE' => true,
                                        'SEARCH' => true,
                                        'QSEARCH' => true,
                                        'CSS' => 'width_pct_50',
                                        'STEP' => 99,
                                        'DISPLAY' => true,
                                        'DISPLAY-UGROUPS' => '',
                                        'EDIT-UGROUPS' => '',
                                ),

                'jobrole_mfk' => array(
			'STEP' => 3,
			'IMPORTANT' => 'IN',
			'SEARCH' => false,
			'SHOW' => true,
			'MINIBOX' => true,
			'MB_CSS' => 'width_pct_100',
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 32,
			'LIST_SEPARATOR' => '، ',
			'TYPE' => 'MFK',
			'ANSWER' => 'jobrole',
			'ANSMODULE' => 'ums',
			'WHERE' => "id_domain in (§domain1_enum§, §domain2_enum§, §domain3_enum§, §domain4_enum§)",

			'SEL_OPTIONS' => array(
				'enableFiltering' => true,
				'numberDisplayed' => 3,
				'filterPlaceholder' => 'اكتب كلمة للبحث',
			),
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),



                'created_by' => array(
                        'SHOW-ADMIN' => true,
                        'RETRIEVE' => false,
                        'EDIT' => false,
                        'QEDIT' => false,
                        'TYPE' => 'FK',
                        'ANSWER' => 'auser',
                        'ANSMODULE' => 'ums',
                        'DISPLAY' => '',
                        'STEP' => 99,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_100',
                ),

                'created_at' => array(
                        'SHOW-ADMIN' => true,
                        'RETRIEVE' => false,
                        'EDIT' => false,
                        'QEDIT' => false,
                        'TYPE' => 'GDAT',
                        'DISPLAY' => '',
                        'STEP' => 99,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_100',
                ),

                'updated_by' => array(
                        'SHOW-ADMIN' => true,
                        'RETRIEVE' => false,
                        'EDIT' => false,
                        'QEDIT' => false,
                        'TYPE' => 'FK',
                        'ANSWER' => 'auser',
                        'ANSMODULE' => 'ums',
                        'DISPLAY' => '',
                        'STEP' => 99,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_100',
                ),

                'updated_at' => array(
                        'SHOW-ADMIN' => true,
                        'RETRIEVE' => false,
                        'EDIT' => false,
                        'QEDIT' => false,
                        'TYPE' => 'GDAT',
                        'DISPLAY' => '',
                        'STEP' => 99,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_100',
                ),

                'validated_by' => array(
                        'SHOW-ADMIN' => true,
                        'RETRIEVE' => false,
                        'EDIT' => false,
                        'QEDIT' => false,
                        'TYPE' => 'FK',
                        'ANSWER' => 'auser',
                        'ANSMODULE' => 'ums',
                        'DISPLAY' => '',
                        'STEP' => 99,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_100',
                ),

                'validated_at' => array(
                        'SHOW-ADMIN' => true,
                        'RETRIEVE' => false,
                        'EDIT' => false,
                        'QEDIT' => false,
                        'TYPE' => 'GDAT',
                        'DISPLAY' => '',
                        'STEP' => 99,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_100',
                ),




                'version'                  => array(
                        'STEP' => 99,
                        'HIDE_IF_NEW' => true,
                        'SHOW' => true,
                        'RETRIEVE' => false,
                        'QEDIT' => false,
                        'TYPE' => 'INT',
                        'FGROUP' => 'tech_fields'
                ),

                'update_groups_mfk'             => array(
                        'STEP' => 99,
                        'HIDE_IF_NEW' => true,
                        'SHOW' => true,
                        'RETRIEVE' => false,
                        'QEDIT' => false,
                        'ANSWER' => 'ugroup',
                        'ANSMODULE' => 'ums',
                        'TYPE' => 'MFK',
                        'FGROUP' => 'tech_fields'
                ),

                'delete_groups_mfk'             => array(
                        'STEP' => 99,
                        'HIDE_IF_NEW' => true,
                        'SHOW' => true,
                        'RETRIEVE' => false,
                        'QEDIT' => false,
                        'ANSWER' => 'ugroup',
                        'ANSMODULE' => 'ums',
                        'TYPE' => 'MFK',
                        'FGROUP' => 'tech_fields'
                ),

                'display_groups_mfk'            => array(
                        'STEP' => 99,
                        'HIDE_IF_NEW' => true,
                        'SHOW' => true,
                        'RETRIEVE' => false,
                        'QEDIT' => false,
                        'ANSWER' => 'ugroup',
                        'ANSMODULE' => 'ums',
                        'TYPE' => 'MFK',
                        'FGROUP' => 'tech_fields'
                ),

                'sci_id'                        => array(
                        'STEP' => 99,
                        'HIDE_IF_NEW' => true,
                        'SHOW' => true,
                        'RETRIEVE' => false,
                        'QEDIT' => false,
                        'TYPE' => 'FK',
                        'ANSWER' => 'scenario_item',
                        'ANSMODULE' => 'ums',
                        'FGROUP' => 'tech_fields'
                ),

                'tech_notes'                         => array(
                        'STEP' => 99,
                        'HIDE_IF_NEW' => true,
                        'TYPE' => 'TEXT',
                        'CATEGORY' => 'FORMULA',
                        'SHOW-ADMIN' => true,
                        'QEDIT' => false,
                        'TOKEN_SEP' => '§',
                        'READONLY' => true,
                        'NO-ERROR-CHECK' => true,
                        'FGROUP' => 'tech_fields'
                ),


        );
}
