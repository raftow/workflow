<?php
try {
        $file_dir_name = dirname(__FILE__);

        require_once("$file_dir_name/../config/global_config.php");
        // old include of afw.php
        // require_once("$file_dir_name/../lib/afw/modes/afw_ config.php");

        $datatable_on = 1;
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

        $actions_tpl_arr['edit'] = array('framework_action');

        $fixed_criterea_arr =  array(
                0 => array('col' => 'workflow_stage_id', 'oper' => '=', 'val' => '4',),
        );

        $current_page = "wsorting.php";
        $formColumns = ['workflow_model_id', 'workflow_session_id', 'workflow_stage_id', 'workflow_status_id'];
        include "$file_dir_name/../lib/afw/modes/afw_mode_qsearch.php";
        $collapse_in = '';

        $wp_title = AfwLanguageHelper::tt('Sorting screen', $lang, $currmod);

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
