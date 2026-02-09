<?php
try {
        $file_dir_name = dirname(__FILE__);

        require_once("$file_dir_name/../config/global_config.php");
        // old include of afw.php
        // require_once("$file_dir_name/../lib/afw/modes/afw_ config.php");

        $cl = 'WorkflowRequest';
        $currmod = 'workflow';
        $currdb = $server_db_prefix . 'workflow';
        $limite = 0;
        $genere_xls = 0;

        $arr_sql_conds = array();
        $arr_sql_conds[] = "me.active='Y'";
        $objme = AfwSession::getUserConnected();
        $myEmplObj = $objme->getEmployee();
        $myEmplId = $objme->getEmployeeId();


        $sql_order_by = 'request_date asc, id asc';


        $actions_tpl_arr = array();
        $action = "retrieve-simple";
        // $actions_tpl_arr['edit'] = array('framework_action');

        $fixed_criterea_arr =  array(
                0 => array('col' => 'workflow_stage_id', 'oper' => '=', 'val' => '3',),
                1 => array('col' => 'datatable_off', 'oper' => '=', 'val' => true,),
        );

        $current_page = "interviewApplicant.php";

        $readOnlyColumns = [
                'workflow_stage_id',
        ];


        $requiredColumns = [
                'workflow_model_id',
                'workflow_session_id',
                'workflow_stage_id',
                'workflow_status_id',
                //'workflow_scope_id',
                //'workflow_sub_scope_id',
        ];

        $formColumns = [
                'workflow_model_id',
                'workflow_session_id',
                'workflow_stage_id',
                'workflow_status_id',
                'workflow_scope_id',
                //'workflow_sub_scope_id',
                'application_class_enum',
                'workflow_source_id',
                'workflow_category_enum'
        ];

        $forced_retrieve_cols = [
                'application_class_enum',
                'original_1',
                'original_2',
                'original_3',
                'original_4',
                'original_5',
                'original_6',
                'email',
                'mobile',   

                /*'original_7',
                'original_8',
                'original_9',
                'original_10'*/
        ];
        $hide_retrieve_cols = [
                'workflow_model_id',
                'workflow_session_id',
                'workflow_stage_id',
                'workflow_status_id',
                //'workflow_scope_id',
                'workflow_sub_scope_id',
                'active',
                'done',
                'orgunit_id',
                'employee_id',
                'request_date',
                'country_id',
                'workflow_source_id'
                
        ];

        $qsearch_page_title = AfwLanguageHelper::tt('Interview screen', $lang, $currmod);
        include "$file_dir_name/../lib/afw/modes/afw_mode_qsearch.php";
        $collapse_in = '';



        /*$out_scr .= "<div class='workflow-title hzm-info'>$wp_title</div>";

        if ($datatable_on) {
                if ($data_count > 0)
                        $out_scr .= $search_result_html;  // die("search_result_html=".$search_result_html); //
                else
                        $out_scr .= '<div class=\'workflow-information hzm-info\'>
        <i class="hzm-container-center hzm-vertical-align-middle hzm-icon-fm hzm-icon-inbox"></i>
        لا يوجد طلبات للمفاضلة
        </div>';
        }
        */
} catch (Exception $e) {
        $out_scr .= $e->getMessage() . "<br>\n" . $e->getFile() . ' Line ' . $e->getLine() . "<br>\n" . $e->getTraceAsString();
}
