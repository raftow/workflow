<?php 

     
        class WorkflowSlotModelAfwStructure
        {
                // token separator = §
                public static function initInstance(&$obj)
                {
                        if ($obj instanceof SlotModel ) 
                        {
                                $obj->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                                $obj->DISPLAY_FIELD_BY_LANG = ['ar'=>"name_ar", 'en'=>"name_en"];
                                
                                // $obj->ENABLE_DISPLAY_MODE_IN_QEDIT=true;
                                $obj->ORDER_BY_FIELDS = "";
                                 
                                
                                
                                // $obj->UNIQUE_KEY = array('XXX', 'YYY');
                                
                $obj->showQeditErrors = true;
                $obj->showRetrieveErrors = true;
                $obj->general_check_errors = true;
                                // $obj->after_save_edit = array("class"=>'SlotModel',"attribute"=>'xxxx_id', "currmod"=>'workflow',"currstep"=>2);
                                $obj->after_save_edit = array("mode"=>"qsearch", "currmod"=>'workflow', "class"=>'SlotModel',"submit"=>true);
                        }
                        else 
                        {
                                SlotModelArTranslator::initData();
                                SlotModelEnTranslator::initData();
                        }
                }
                
                
                public static $DB_STRUCTURE =  
     array(
                'id' => array('SHOW' => true, 'RETRIEVE' => true, 'EDIT' => false, 'TYPE' => 'PK'),

		
	
		'interview_type_pattern_id' => array('SHORTNAME' => 'type_pattern',  'SEARCH' => true,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => true,  
				'EDIT' => true,  'QEDIT' => true,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'interview_type_pattern',  'ANSMODULE' => 'workflow',  
				'RELATION' => 'unkn',  'READONLY' => false,  'DNA' => true, 
				'CSS' => 'width_pct_50', ),

		'workflow_session_id' => array('SEARCH' => true,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false,  
				'EDIT' => true,  'QEDIT' => false,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'workflow_session',  'ANSMODULE' => 'workflow',  
				'CSS' => 'width_pct_50', ),

		'workflow_scope_id' => array('SEARCH' => true,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false,  
				'EDIT' => true,  'QEDIT' => false,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'workflow_scope',  'ANSMODULE' => 'workflow',
				'CSS' => 'width_pct_50', ),

		'workflow_stage_id' => array('SHORTNAME' => 'stage',  'SEARCH' => true,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => true,  
				'EDIT' => true,  'QEDIT' => true,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'workflow_stage',  'ANSMODULE' => 'workflow',  
				'RELATION' => 'unkn',  'READONLY' => false,  'DNA' => true, 
				'CSS' => 'width_pct_50', ),

		'interview_date' => array('SEARCH' => true,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => true,  
				'EDIT' => true,  'QEDIT' => true,  
				'SIZE' => 10,  'MAXLENGTH' => 10,  'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'DATE',  'FORMAT' => 'HIJRI_UNIT',  'READONLY' => false,  'DNA' => true, 
				'CSS' => 'width_pct_50', ),

		'start_time' => array('SEARCH' => true,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false,  
				'EDIT' => true,  'QEDIT' => false,  
				'SIZE' => 8,  'MAXLENGTH' => 8,  'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'TIME',  'READONLY' => false,  'DNA' => true, 
				'CSS' => 'width_pct_50', ),

		'end_time' => array('SEARCH' => true,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false,  
				'EDIT' => true,  'QEDIT' => false,  
				'SIZE' => 8,  'MAXLENGTH' => 8,  'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'TIME',  'READONLY' => false,  'DNA' => true, 
				'CSS' => 'width_pct_50', ),

		'total_duration' => array('SEARCH' => true,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false,  
				'EDIT' => true,  'QEDIT' => false,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'INT',  'READONLY' => false,  'DNA' => true, 
				'CSS' => 'width_pct_50', ),

		'single_duration' => array('SEARCH' => true,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false,  
				'EDIT' => true,  'QEDIT' => false,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",  'MANDATORY' => false,  'UTF8' => false,  
				'TYPE' => 'INT',  'READONLY' => false,  'DNA' => true, 
				'CSS' => 'width_pct_50', ),

		'single_interviews_total' => array('SEARCH' => true,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false,  
				'EDIT' => true,  'QEDIT' => false,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",  'MANDATORY' => false,  'UTF8' => false,  
				'TYPE' => 'INT',  'READONLY' => false,  'DNA' => true, 
				'CSS' => 'width_pct_50', ),

		'capacity' => array('SEARCH' => true,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => true,  
				'EDIT' => true,  'QEDIT' => false,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",  'MANDATORY' => false,  'UTF8' => false,  
				'TYPE' => 'INT',  'READONLY' => false,  'DNA' => true, 
				'CSS' => 'width_pct_50', ),

		'interview_type' => array('SEARCH' => true,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false,  
				'EDIT' => true,  'QEDIT' => false,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'ENUM',  'ANSWER' => 'FUNCTION',  
				'CSS' => 'width_pct_50', ),

		'room_location' => array('SEARCH' => true,  'QSEARCH' => true,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false,  
				'EDIT' => true,  'QEDIT' => false,  
				'SIZE' => 255,  'MAXLENGTH' => 255,  'MIN-SIZE' => 16,  'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",  'MANDATORY' => false,  'UTF8' => true,  
				'TYPE' => 'TEXT',  'READONLY' => false,  'DNA' => true, 
				'CSS' => 'width_pct_50', ),

		'workflow_commitee_id' => array('SHORTNAME' => 'commitee',  'SEARCH' => true,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => true,  
				'EDIT' => true,  'QEDIT' => false,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",  'MANDATORY' => false,  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'workflow_commitee',  'ANSMODULE' => 'workflow',  
				'RELATION' => 'unkn',  'READONLY' => false,  'DNA' => true, 
				'CSS' => 'width_pct_50', ),

		'buffer_minutes' => array('SEARCH' => true,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false,  
				'EDIT' => true,  'QEDIT' => false,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",  'MANDATORY' => false,  'UTF8' => false,  
				'TYPE' => 'INT',  'READONLY' => false,  'DNA' => true, 
				'CSS' => 'width_pct_50', ),

                
                'created_by'         => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, "TECH_FIELDS-RETRIEVE" => true, 'RETRIEVE' => false,  'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),
                'created_at'         => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, "TECH_FIELDS-RETRIEVE" => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'DATETIME', 'FGROUP' => 'tech_fields'),
                'updated_by'         => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, "TECH_FIELDS-RETRIEVE" => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),
                'updated_at'         => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, "TECH_FIELDS-RETRIEVE" => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'DATETIME', 'FGROUP' => 'tech_fields'),
                'validated_by'       => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),
                'validated_at'       => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'DATETIME', 'FGROUP' => 'tech_fields'),
                'active'             => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'EDIT' => false, 'QEDIT' => false, "DEFAULT" => 'Y', 'TYPE' => 'YN', 'FGROUP' => 'tech_fields'),
                'version'            => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'INT', 'FGROUP' => 'tech_fields'),
                'draft'             => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'EDIT' => false, 'QEDIT' => false, "DEFAULT" => 'Y', 'TYPE' => 'YN', 'FGROUP' => 'tech_fields'),
                'update_groups_mfk' => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields'),
                'delete_groups_mfk' => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields'),
                'display_groups_mfk' => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields'),
                'sci_id'            => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'scenario_item', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),
                'tech_notes' 	      => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'TYPE' => 'TEXT', 'CATEGORY' => 'FORMULA', "SHOW-ADMIN" => true, 'TOKEN_SEP'=>"§", 'READONLY' =>true, "NO-ERROR-CHECK"=>true, 'FGROUP' => 'tech_fields'),
	);  
    
         }
    


// errors 
