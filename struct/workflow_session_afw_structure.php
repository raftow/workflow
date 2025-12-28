<?php

class WorkflowWorkflowSessionAfwStructure
 {
    // token separator = §
    public static function initInstance( &$obj )
 {
        if ( $obj instanceof WorkflowSession ) 
 {
            $obj->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
            $obj->DISPLAY_FIELD_BY_LANG = [ 'ar'=>'workflow_session_name_ar', 'en'=>'workflow_session_name_en' ];

            // $obj->ENABLE_DISPLAY_MODE_IN_QEDIT = true;
            $obj->ORDER_BY_FIELDS = '';

            $obj->UNIQUE_KEY = array( 'workflow_model_id', 'external_code' );

            $obj->showQeditErrors = true;
            $obj->showRetrieveErrors = true;
            $obj->general_check_errors = true;
            // $obj->after_save_edit = array( 'class'=>'WorkflowSession', 'attribute'=>'xxxx_id', 'currmod'=>'workflow', 'currstep'=>2 );
            $obj->after_save_edit = array( 'mode'=>'qsearch', 'currmod'=>'workflow', 'class'=>'WorkflowSession', 'submit'=>true );
        } else {
            WorkflowSessionArTranslator::initData();
            WorkflowSessionEnTranslator::initData();
        }
    }

    public static $DB_STRUCTURE =
    array(
        'id' => array( 'SHOW' => true, 'RETRIEVE' => true, 'EDIT' => false, 'TYPE' => 'PK' ),

        'workflow_model_id' => array( 'SHORTNAME' => 'module',  'SEARCH' => true,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => true,
        'EDIT' => true,  'QEDIT' => true,
        'SIZE' => 32,  'MAXLENGTH' => 32,  'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE',  'MANDATORY' => true,  'UTF8' => false,
        'TYPE' => 'FK',  'ANSWER' => 'workflow_model',  'ANSMODULE' => 'workflow',
        'RELATION' => 'unkn',  'READONLY' => false,  'DNA' => true,
        'CSS' => 'width_pct_50', ),

        'external_code' => array( 'SEARCH' => true,  'QSEARCH' => true,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => true,
        'EDIT' => true,  'QEDIT' => true,
        'SIZE' => 16,  'MAXLENGTH' => 16,  'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE',  'MANDATORY' => true,  'UTF8' => true,
        'TYPE' => 'TEXT',  'READONLY' => false,  'DNA' => true,
        'CSS' => 'width_pct_50', ),

        'session_code' => array( 'SEARCH' => true,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => true,
        'EDIT' => true,  'QEDIT' => true,
        'SIZE' => 16,  'MAXLENGTH' => 16,  'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE',  'MANDATORY' => false,  'UTF8' => true,
        'TYPE' => 'TEXT',  'READONLY' => false,  'DNA' => true,
        'CSS' => 'width_pct_50', ),

        'workflow_session_name_ar' => array( 'SEARCH' => true,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => true,
        'EDIT' => true,  'QEDIT' => false,
        'SIZE' => 200,  'MAXLENGTH' => 200,  'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE',  'MANDATORY' => true,  'UTF8' => true,
        'TYPE' => 'TEXT',  'READONLY' => false,  'DNA' => true,
        'CSS' => 'width_pct_50', ),

        'workflow_session_name_en' => array( 'SEARCH' => true,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => true,
        'EDIT' => true,  'QEDIT' => false,
        'SIZE' => 200,  'MAXLENGTH' => 200,  'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE',  'MANDATORY' => true,  'UTF8' => false,
        'TYPE' => 'TEXT',  'READONLY' => false,  'DNA' => true,
        'CSS' => 'width_pct_50', ),

        'workflow_session_desc_ar' => array( 'SEARCH' => true,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => true,
        'EDIT' => true,  'QEDIT' => false,
        'SIZE' => 'AREA',    'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE',  'MANDATORY' => true,  'UTF8' => true,
        'TYPE' => 'TEXT',  'READONLY' => false,  'DNA' => true,
        'CSS' => 'width_pct_50', ),

        'workflow_session_desc_en' => array( 'SEARCH' => true,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => true,
        'EDIT' => true,  'QEDIT' => false,
        'SIZE' => 'AREA',    'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE',  'MANDATORY' => true,  'UTF8' => false,
        'TYPE' => 'TEXT',  'READONLY' => false,  'DNA' => true,
        'CSS' => 'width_pct_50', ),

        'created_by'         => array( 'STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'TECH_FIELDS-RETRIEVE' => true, 'RETRIEVE' => false,  'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields' ),
        'created_at'         => array( 'STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'TECH_FIELDS-RETRIEVE' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'DATETIME', 'FGROUP' => 'tech_fields' ),
        'updated_by'         => array( 'STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'TECH_FIELDS-RETRIEVE' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields' ),
        'updated_at'         => array( 'STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'TECH_FIELDS-RETRIEVE' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'DATETIME', 'FGROUP' => 'tech_fields' ),
        'validated_by'       => array( 'STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields' ),
        'validated_at'       => array( 'STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'DATETIME', 'FGROUP' => 'tech_fields' ),
        'active'             => array( 'STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'EDIT' => false, 'QEDIT' => false, 'DEFAULT' => 'Y', 'TYPE' => 'YN', 'FGROUP' => 'tech_fields' ),
        'version'            => array( 'STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'INT', 'FGROUP' => 'tech_fields' ),
        'draft'             => array( 'STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'EDIT' => false, 'QEDIT' => false, 'DEFAULT' => 'Y', 'TYPE' => 'YN', 'FGROUP' => 'tech_fields' ),
        'update_groups_mfk' => array( 'STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields' ),
        'delete_groups_mfk' => array( 'STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields' ),
        'display_groups_mfk' => array( 'STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields' ),
        'sci_id'            => array( 'STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'scenario_item', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields' ),
        'tech_notes' 	      => array( 'STEP' =>99, 'HIDE_IF_NEW' => true, 'TYPE' => 'TEXT', 'CATEGORY' => 'FORMULA', 'SHOW-ADMIN' => true, 'TOKEN_SEP'=>'§', 'READONLY' =>true, 'NO-ERROR-CHECK'=>true, 'FGROUP' => 'tech_fields' ),
    );

}

// errors

