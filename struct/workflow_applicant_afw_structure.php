<?php
class WorkflowWorkflowApplicantAfwStructure
{

        public static function initInstance(&$obj)
        {
                if ($obj instanceof WorkflowApplicant) {
                        $obj->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 3;
                        $obj->DISPLAY_FIELD_BY_LANG = array(
                                'ar' => ['first_name_ar', 'father_name_ar', 'last_name_ar'],
                                'en' => ['first_name_en', 'father_name_en', 'last_name_en']
                        );
                        $obj->DISPLAY_SEPARATOR = ' ';
                        $obj->FORMULA_DISPLAY_FIELD  = "concat(IF(ISNULL(first_name_ar), '', first_name_ar) , ' ' , IF(ISNULL(father_name_ar), '', father_name_ar) , ' ' , IF(ISNULL(last_name_ar), '', last_name_ar))";
                        // $obj->ORDER_BY_FIELDS = "xxxx, yyyy";
                        $obj->UNIQUE_KEY = array('country_id', 'idn_type_id', 'idn');
                        // $obj->public_display = true;
                        // $obj->IS_LOOKUP = true;

                        $obj->editByStep = true;
                        $obj->editNbSteps = 11;
                        // $obj->STEP_OPTIONS = [2=> ['TEMPLATE'=>'accordion'], /* 3=> ['TEMPLATE'=>'accordion'],*/];

                        // $obj->after_save_edit = array("class"=>'aconditionOriginType',"attribute"=>'acondition_origin_type_id', "currmod"=>'workflow',"currstep"=>1);
                } else {
                        WorkflowApplicantArTranslator::initData();
                        WorkflowApplicantEnTranslator::initData();
                }
        }


        public static $DB_STRUCTURE = array(
                'id' => array(
                        'FGROUP' => 'idn-infos',
                        'SHOW' => false,
                        'RETRIEVE' => false,
                        'EDIT' => false,
                        'TYPE' => 'PK',
                        'DISPLAY' => true,
                        'QSEARCH' => true,
                        'TEXT-SEARCHABLE-SEPARATED' => true,
                        'STEP' => 1,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_25'
                ),




                'idn_type_id' => array(
                        'STEP' => 1,
                        'SHORTNAME' => 'idntype',
                        'SEARCH' => false,
                        'QSEARCH' => false,
                        'SHOW' => true,
                        'RETRIEVE' => false,
                        'EDIT' => true,
                        'QEDIT' => false,
                        'SIZE' => 16,
                        'MANDATORY' => true,
                        'UTF8' => false,
                        'TYPE' => 'ENUM',
                        'ANSWER' => 'FUNCTION',
                        'READONLY' => false,
                        'EDIT-SHORT-LIST' => true,
                        'ANSMODULE' => 'crm',
                        'SEARCH-BY-ONE' => false,
                        'DISPLAY' => true,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'ERROR-CHECK' => true,
                ),

                'country_id' => array(
                        'FGROUP' => 'idn-infos',
                        'IMPORTANT' => 'IN',
                        'SEARCH' => true,
                        'QSEARCH' => true,
                        'RETRIEVE' => true,

                        'SHOW' => true,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'SHOW-ADMIN' => true,
                        'EDIT-ADMIN' => true,
                        'UTF8' => false,
                        'TYPE' => 'FK',
                        'ANSWER' => 'country',
                        'ANSMODULE' => 'ums',
                        'SIZE' => 40,
                        'DEFAUT' => 0,
                        'READONLY-AFTER-INSERT' => true,
                        'DISPLAY' => true,
                        'STEP' => 1,
                        'RELATION' => 'ManyToOne',
                        'MANDATORY' => true,
                        'READONLY' => false,
                        'AUTOCOMPLETE' => false,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_25',
                ),


                'idn' => array(
                        'FGROUP' => 'idn-infos',
                        'IMPORTANT' => 'IN',
                        'SEARCH' => true,
                        'QSEARCH' => true,
                        'SHOW' => true,
                        'RETRIEVE' => true,
                        // we dont know thw country id of applicant in qsearch mode to be able 
                        // to convert IDN to ID except if it SAUDI IDN
                        "CLAUSE-WHERE-COL" => 'id',
                        "CLAUSE-WHERE-COL-VALUE-CONVERT-CLASS" => 'WorkflowApplicant',
                        "CLAUSE-WHERE-COL-VALUE-CONVERT-METHOD" => 'tryConvertIdnToID',
                        'EDIT' => true,
                        'QEDIT' => true,
                        'SIZE' => '32',
                        'MAXLENGTH' => '32',
                        'TYPE' => 'TEXT',
                        'DISPLAY' => true,
                        'STEP' => 1,
                        'REQUIRED' => true,
                        'READONLY-AFTER-INSERT' => true,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'TEXT-SEARCHABLE-SEPARATED' => true,
                        'FORMAT' => '::idnFormat',
                        'CSS' => 'width_pct_25'
                ),



                'id_issue_place' => array(
                        'FGROUP' => 'idn-infos',
                        'IMPORTANT' => 'IN',
                        'SEARCH' => true,
                        'QSEARCH' => true,
                        'SHOW' => false,
                        'RETRIEVE' => false,
                        'EDIT' => false,
                        'QEDIT' => true,
                        'SIZE' => '30',
                        'MAXLENGTH' => '30',
                        'UTF8' => true,
                        'TYPE' => 'TEXT',
                        'DISPLAY' => true,
                        'STEP' => 1,
                        'MANDATORY' => false,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_50'
                ),



                'id_issue_date' => [
                        'FGROUP' => 'idn-infos',
                        'IMPORTANT' => 'IN',
                        'SEARCH' => true,
                        'SHOW' => true,
                        'RETRIEVE' => false,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'SEARCH-ADMIN' => true,
                        //'SHOW-ADMIN' => true,
                        //'EDIT-ADMIN' => true,
                        'UTF8' => false,
                        'TYPE' => 'GDAT',
                        'FORMAT' => 'DATE',
                        'DISPLAY' => true,
                        'STEP' => 1,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',

                        'CSS' => 'width_pct_50',
                ],


                'id_expiry_date' => [
                        'FGROUP' => 'idn-infos',
                        'IMPORTANT' => 'IN',
                        'SEARCH' => true,
                        'SHOW' => true,
                        'DISPLAY' => true,
                        'RETRIEVE' => false,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'SEARCH-ADMIN' => true,
                        'SHOW-ADMIN' => true,
                        'EDIT-ADMIN' => true,
                        'UTF8' => false,
                        'TYPE' => 'GDAT',
                        'FORMAT' => 'DATE',
                        'STEP' => 1,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',

                        'CSS' => 'width_pct_50',
                ],

                'mobile' => array(
                        'FGROUP' => 'profile',
                        'IMPORTANT' => 'IN',
                        'FORMAT' => 'SA-MOBILE',

                        'STEP' => 1,
                        'MANDATORY' => true,
                        'SEARCH' => true,
                        'QSEARCH' => true,
                        'SHOW' => true,
                        'RETRIEVE' => true,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'CSS' => 'width_pct_50',
                        'SIZE' => '25',
                        'MAXLENGTH' => '25',
                        'UTF8' => true,
                        'TEXT-SEARCHABLE-SEPARATED' => true,
                        'TYPE' => 'TEXT',
                        'DISPLAY' => true,

                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',

                ),


                'email' => array(
                        'FGROUP' => 'profile',
                        'IMPORTANT' => 'IN',
                        'FORMAT' => 'EMAIL',

                        'STEP' => 1,
                        'MANDATORY' => true,
                        'SEARCH' => true,
                        'QSEARCH' => true,
                        'SHOW' => true,
                        'RETRIEVE' => true,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'CSS' => 'width_pct_50',
                        'SIZE' => '25',
                        'MAXLENGTH' => '25',
                        'UTF8' => true,
                        'TEXT-SEARCHABLE-SEPARATED' => true,
                        'TYPE' => 'TEXT',
                        'DISPLAY' => true,

                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_50'
                ),


                'gender_enum' => array(
                        'FGROUP' => 'profile',
                        'IMPORTANT' => 'IN',
                        'SEARCH' => false,
                        'SHOW' => true,
                        'RETRIEVE' => true,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'QSEARCH' => false,
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







                'first_name_ar' => array(
                        'FGROUP' => 'profile',
                        'IMPORTANT' => 'IN',
                        'SEARCH' => true,
                        'QSEARCH' => true,
                        'SHOW' => true,
                        'RETRIEVE-AR' => true,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'SIZE' => '32',
                        'MAXLENGTH' => '32',
                        'UTF8' => true,
                        'TYPE' => 'TEXT',
                        'DISPLAY' => true,
                        'STEP' => 2,
                        'MANDATORY' => true,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_25',
                ),



                'father_name_ar' => array(
                        'FGROUP' => 'profile',
                        'IMPORTANT' => 'IN',
                        'SEARCH' => true,
                        'QSEARCH' => true,
                        'SHOW' => true,
                        'RETRIEVE-AR' => true,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'SIZE' => '32',
                        'MAXLENGTH' => '32',
                        'UTF8' => true,
                        'TYPE' => 'TEXT',
                        'DISPLAY' => true,
                        'STEP' => 2,
                        'MANDATORY' => true,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_25',
                ),



                'middle_name_ar' => array(
                        'FGROUP' => 'profile',
                        'IMPORTANT' => 'IN',
                        'SEARCH' => true,
                        'QSEARCH' => true,
                        'SHOW' => true,
                        'RETRIEVE-AR' => false,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'SIZE' => '32',
                        'MAXLENGTH' => '32',
                        'UTF8' => true,
                        'TYPE' => 'TEXT',
                        'DISPLAY' => true,
                        'STEP' => 2,
                        'MANDATORY' => true,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_25',
                ),



                'last_name_ar' => array(
                        'FGROUP' => 'profile',
                        'IMPORTANT' => 'IN',
                        'SEARCH' => true,
                        'QSEARCH' => true,
                        'SHOW' => true,
                        'RETRIEVE-AR' => true,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'SIZE' => '32',
                        'MAXLENGTH' => '32',
                        'UTF8' => true,
                        'TYPE' => 'TEXT',
                        'DISPLAY' => true,
                        'STEP' => 2,
                        'MANDATORY' => true,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_25',
                ),




                'first_name_en' => array(
                        'FGROUP' => 'profile',
                        'IMPORTANT' => 'IN',
                        'SEARCH' => true,
                        'QSEARCH' => true,
                        'SHOW' => true,
                        'RETRIEVE-EN' => true,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'SIZE' => '32',
                        'MAXLENGTH' => '32',
                        'UTF8' => true,
                        'TYPE' => 'TEXT',
                        'DISPLAY' => true,
                        'STEP' => 2,
                        'MANDATORY' => true,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_25',
                ),



                'father_name_en' => array(
                        'FGROUP' => 'profile',
                        'IMPORTANT' => 'IN',
                        'SEARCH' => true,
                        'QSEARCH' => true,
                        'SHOW' => true,
                        'RETRIEVE-EN' => false,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'SIZE' => '32',
                        'MAXLENGTH' => '32',
                        'UTF8' => true,
                        'TYPE' => 'TEXT',
                        'DISPLAY' => true,
                        'STEP' => 2,
                        'MANDATORY' => true,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_25',
                ),



                'middle_name_en' => array(
                        'FGROUP' => 'profile',
                        'IMPORTANT' => 'IN',
                        'SEARCH' => true,
                        'QSEARCH' => true,
                        'SHOW' => true,
                        'RETRIEVE-EN' => false,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'SIZE' => '32',
                        'MAXLENGTH' => '32',
                        'UTF8' => true,
                        'TYPE' => 'TEXT',
                        'DISPLAY' => true,
                        'STEP' => 2,
                        'MANDATORY' => true,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_25',
                ),



                'last_name_en' => array(
                        'FGROUP' => 'profile',
                        'IMPORTANT' => 'IN',
                        'SEARCH' => true,
                        'QSEARCH' => true,
                        'SHOW' => true,
                        'RETRIEVE-EN' => true,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'SIZE' => '32',
                        'MAXLENGTH' => '32',
                        'UTF8' => true,
                        'TYPE' => 'TEXT',
                        'DISPLAY' => true,
                        'STEP' => 2,
                        'MANDATORY' => true,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_25',
                ),


                'passeport_num' => array(
                        'FGROUP' => 'profile',
                        'IMPORTANT' => 'IN',
                        'SEARCH' => true,
                        'QSEARCH' => true,
                        'SHOW' => true,
                        'RETRIEVE' => false,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'SIZE' => '32',
                        'FORMAT' => ['STRING-LENGTH' => true,],
                        'MAXLENGTH' => '32',
                        'MIN-SIZE' => '5',
                        'UTF8' => true,
                        'TYPE' => 'TEXT',
                        'DISPLAY' => true,
                        'STEP' => 2,
                        'MANDATORY' => false,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_25',
                ),


                'passeport_expiry_gdate' => [
                        'FGROUP' => 'profile',
                        'IMPORTANT' => 'IN',
                        'SEARCH' => true,
                        'SHOW' => true,
                        'DISPLAY' => true,
                        'RETRIEVE' => false,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'SEARCH-ADMIN' => true,
                        'SHOW-ADMIN' => true,
                        'EDIT-ADMIN' => true,
                        'UTF8' => false,
                        'TYPE' => 'GDATE',
                        'FORMAT' => 'DATE',
                        'STEP' => 2,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'MANDATORY' => false,
                        'CSS' => 'width_pct_25',
                ],

                'dragDropDiv' => array(
                        'STEP' => 6,
                        'TYPE' => 'TEXT',
                        'CATEGORY' => 'FORMULA',
                        'SHOW' => true,
                        'EDIT' => true,
                        'READONLY' => true,
                        "CAN-BE-SETTED" => false,
                        'SIZE' => 255,
                        "NO-LABEL" => true,
                        'INPUT_WIDE' => true
                ),

                'workflowApplicantFileList' => array(
                        'STEP' => 6,
                        'SHOW' => true,
                        'FORMAT' => 'retrieve',
                        'ICONS' => true,
                        'DELETE-ICON' => true,
                        'BUTTONS' => true,
                        'SEARCH' => false,
                        'QSEARCH' => false,
                        'AUDIT' => false,
                        'RETRIEVE' => false,
                        'EDIT' => true,
                        'QEDIT' => false,
                        'SIZE' => 32,
                        'MAXLENGTH' => 32,
                        'MIN-SIZE' => 1,
                        'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",
                        'MANDATORY' => false,
                        'UTF8' => false,
                        'TYPE' => 'FK',
                        'CATEGORY' => 'ITEMS',
                        'ANSWER' => 'workflow_applicant_file',
                        'ANSMODULE' => 'workflow',
                        'ITEM' => 'workflow_applicant_id',
                        'READONLY' => true,
                        'CAN-BE-SETTED' => true,
                        'CSS' => 'width_pct_100',
                ),


                'workflowRequestList' => array(
                        'STEP' => 5,
                        'FGROUP' => 'appl',
                        'SHOW' => true,
                        'FORMAT' => 'retrieve',
                        'ICONS' => true,
                        'DELETE-ICON' => true,
                        'BUTTONS' => true,
                        'SEARCH' => false,
                        'QSEARCH' => false,
                        'AUDIT' => false,
                        'RETRIEVE' => false,
                        'EDIT' => false,
                        'QEDIT' => false,
                        'SIZE' => 32,
                        'MAXLENGTH' => 32,
                        'MIN-SIZE' => 1,
                        'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",
                        'MANDATORY' => false,
                        'UTF8' => false,
                        'TYPE' => 'FK',
                        'CATEGORY' => 'ITEMS',
                        'ANSWER' => 'workflow_request',
                        'ANSMODULE' => 'workflow',
                        'ITEM' => 'workflow_applicant_id',
                        'READONLY' => true,
                        'CAN-BE-SETTED' => true,
                        'CSS' => 'width_pct_100',
                ),


                'active' => array(
                        'SHOW' => true,
                        'RETRIEVE' => true,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'DEFAUT' => 'Y',
                        'TYPE' => 'YN',
                        'FORMAT' => 'icon',
                        'STEP' => 99,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_25',
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
                        'CSS' => 'width_pct_25',
                ),

                'created_at' => array(
                        'SHOW-ADMIN' => true,
                        'RETRIEVE' => false,
                        'EDIT' => false,
                        'QEDIT' => false,
                        'TYPE' => 'GDAT',
                        'FORMAT' => 'DATETIME',
                        'DISPLAY' => '',
                        'STEP' => 99,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_25',
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
                        'CSS' => 'width_pct_25',
                ),

                'updated_at' => array(
                        'SHOW-ADMIN' => true,
                        'RETRIEVE' => false,
                        'QEDIT' => false,
                        'TYPE' => 'GDAT',
                        'FORMAT' => 'DATETIME',
                        'DISPLAY' => '',
                        'STEP' => 99,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'CSS' => 'width_pct_25',
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
                        'CSS' => 'width_pct_25',
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
                        'CSS' => 'width_pct_25',
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
                        'TYPE' => 'INT', /*stepnum-not-the-object*/
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
