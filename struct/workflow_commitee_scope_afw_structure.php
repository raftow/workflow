<?php

class WorkflowWorkflowCommiteeScopeAfwStructure
 {

    public static function initInstance( &$obj )
 {
        if ( $obj instanceof WorkflowCommiteeScope ) 
 {
            $obj->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 3;
            $obj->DISPLAY_FIELD = 'workflow_commitee_scope_name_ar';
            // $obj->ORDER_BY_FIELDS = 'xxxx, yyyy';
            $obj->UNIQUE_KEY = array( 'workflow_commitee_id', 'workflow_scope_id' );
            // $obj->public_display = true;
            // $obj->IS_LOOKUP = true;

            $obj->editByStep = false;
            //$obj->editNbSteps = 1;

            // $obj->after_save_edit = array( 'class'=>'aconditionOriginType', 'attribute'=>'acondition_origin_type_id', 'currmod'=>'workflow', 'currstep'=>1 );
            $obj->after_save_edit = array( 'mode'=>'qsearch', 'currmod'=>'adm', 'class'=>'WorkflowCommiteeScope', 'submit'=>true );
        } else {
            WorkflowCommiteeScopeArTranslator::initData();
            WorkflowCommiteeScopeEnTranslator::initData();
        }
    }

    public static $DB_STRUCTURE = array(
        'id' => array( 'SHOW' => false,  'RETRIEVE' => true,  'EDIT' => false,
                'TYPE' => 'PK',    'DISPLAY' => true,  'STEP' => 1,
                'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',
                'CSS' => 'width_pct_25', ),

        'workflow_commitee_id' => array( 'IMPORTANT' => 'IN',  'SEARCH' => true, 'QSEARCH' => true, 'SHOW' => true,  'RETRIEVE' => true,
                'EDIT' => true,  'QEDIT' => true, 'SHOW-ADMIN' => true,  'EDIT-ADMIN' => true,  'UTF8' => false,
                'TYPE' => 'FK',  'ANSWER' => 'workflow_commitee',  'ANSMODULE' => 'workflow',  'SIZE' => 40,  'DEFAUT' => 0,
                'DISPLAY' => true,  'STEP' => 1,  'RELATION' => 'OneToMany', 'MANDATORY' => true, 'READONLY'=>false, 'AUTOCOMPLETE' => false,
                'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',
                'CSS' => 'width_pct_25', ),

        'workflow_scope_id' => array( 'IMPORTANT' => 'IN',  'SEARCH' => true, 'QSEARCH' => true, 'SHOW' => true,  'RETRIEVE' => true,
                'EDIT' => true,  'QEDIT' => true, 'SHOW-ADMIN' => true,  'EDIT-ADMIN' => true,  'UTF8' => false,
                'TYPE' => 'FK',  'ANSWER' => 'workflow_scope',  'ANSMODULE' => 'workflow',  'SIZE' => 40,  'DEFAUT' => 0,
                'DISPLAY' => true,  'STEP' => 1,  'RELATION' => 'ManyToOne', 'MANDATORY' => true, 'READONLY'=>false, 'AUTOCOMPLETE' => false,
                'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',
                'CSS' => 'width_pct_25', ),

        'active' => array( 'SHOW' => true,  'RETRIEVE' => true,  'EDIT' => true, 'QEDIT' => true, 'DEFAUT' => 'Y',
                'TYPE' => 'YN',    'FORMAT' => 'icon',  'STEP' => 99,
                'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',
                'CSS' => 'width_pct_25', ),

        'created_by' => array( 'SHOW-ADMIN' => true,  'RETRIEVE' => false,  'EDIT' => false, 'QEDIT' => false,
                'TYPE' => 'FK',  'ANSWER' => 'auser',  'ANSMODULE' => 'ums',    'DISPLAY' => '',  'STEP' => 99,
                'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',
                'CSS' => 'width_pct_100', ),

        'created_at' => array( 'SHOW-ADMIN' => true,  'RETRIEVE' => false,  'EDIT' => false, 'QEDIT' => false,
                'TYPE' => 'GDAT',    'DISPLAY' => '',  'STEP' => 99,
                'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',
                'CSS' => 'width_pct_100', ),

        'updated_by' => array( 'SHOW-ADMIN' => true,  'RETRIEVE' => false,  'EDIT' => false, 'QEDIT' => false,
        'TYPE' => 'FK',  'ANSWER' => 'auser',  'ANSMODULE' => 'ums',    'DISPLAY' => '',  'STEP' => 99,
        'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',
        'CSS' => 'width_pct_100', ),

        'updated_at' => array( 'SHOW-ADMIN' => true,  'RETRIEVE' => false,  'EDIT' => false, 'QEDIT' => false,
        'TYPE' => 'GDAT',    'DISPLAY' => '',  'STEP' => 99,
        'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',
        'CSS' => 'width_pct_100', ),

        'validated_by' => array( 'SHOW-ADMIN' => true,  'RETRIEVE' => false,  'EDIT' => false, 'QEDIT' => false,
        'TYPE' => 'FK',  'ANSWER' => 'auser',  'ANSMODULE' => 'ums',    'DISPLAY' => '',  'STEP' => 99,
        'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',
        'CSS' => 'width_pct_100', ),

        'validated_at' => array( 'SHOW-ADMIN' => true,  'RETRIEVE' => false,  'EDIT' => false, 'QEDIT' => false,
        'TYPE' => 'GDAT',    'DISPLAY' => '',  'STEP' => 99,
        'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',
        'CSS' => 'width_pct_100', ),

        'version'                  => array( 'STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false,
        'QEDIT' => false, 'TYPE' => 'INT', 'FGROUP' => 'tech_fields' ),

        'update_groups_mfk'             => array( 'STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false,
        'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields' ),

        'delete_groups_mfk'             => array( 'STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false,
        'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields' ),

        'display_groups_mfk'            => array( 'STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false,
        'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields' ),

        'sci_id'                        => array( 'STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false,
        'TYPE' => 'FK', 'ANSWER' => 'scenario_item', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields' ),

        'tech_notes' 	                => array( 'STEP' => 99, 'HIDE_IF_NEW' => true, 'TYPE' => 'TEXT', 'CATEGORY' => 'FORMULA', 'SHOW-ADMIN' => true,  'QEDIT' => false,
        'TOKEN_SEP'=>'§', 'READONLY'=>true, 'NO-ERROR-CHECK'=>true, 'FGROUP' => 'tech_fields' ),

    );

}

?>