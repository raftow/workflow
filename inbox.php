<?php

/**
 * @var string $out_scr
 * @var string $lang
 */
try {


        require_once(dirname(__FILE__) . "/../config/global_config.php");
        // old include of afw.php
        // require_once( dirname(__FILE__)."/../lib/afw/modes/afw_ config.php");

        $datatable_on = 1;
        $cl = 'WorkflowRequest';
        $currmod = 'workflow';
        //$currdb = $server_db_prefix . 'workflow';
        $limite = 0;
        $genere_xls = 0;

        $arr_sql_conds = array();
        $arr_sql_conds[] = "me.active='Y'";
        $objme = AfwSession::getUserConnected();
        $myEmplObj = $objme->getEmployee();
        $myEmplId = $objme->getEmployeeId();

        if (!$myEmplObj) {
                $arr_sql_conds[] = "1=0";
                $employee_title = "No employee account defined for this user";
        } elseif ($myEmplObj->hasRole("workflow", 393))  // مدير قبول
        {
                $arr_sql_conds[] = WorkflowRequest::inboxSqlCond($myEmplId);
                $orgunit_name = WorkflowEmployee::orgOfEmployee($myEmplId, false, false, AfwLanguageHelper::tt('مدير القبول في', $lang));
                $employee_title = '<b>' . $objme->getShortDisplay($lang) . '</b>';

                if ($orgunit_name)
                        $employee_title .= ' ' . $orgunit_name;
        } else {
                $arr_sql_conds[] = WorkflowRequest::inboxSqlCond($myEmplId);
                $orgunit_name = WorkflowEmployee::orgOfEmployee($myEmplId, false, false, AfwLanguageHelper::tt('موظف القبول في', $lang));
                $employee_title = '<b>' . $objme->getShortDisplay($lang) . '</b>';

                if ($orgunit_name)
                        $employee_title .= ' ' . $orgunit_name;
                // else $employee_title .= " xx";
        }

        $sql_order_by = 'request_date asc, id asc';

        // $my_class = new $cl();

        $result_page_title = 'صندوق الوارد';
        $result_page_title = UfwReplacement::trans_replace($result_page_title, "workflow", $lang);
        $tit_qedit_ppp_fixm = 'عرض التذكرة';
        // $actions_tpl_arr = array();
        // $actions_tpl_arr['edit'] = array('framework_action');

        $addHeader = false;
        $takeViewIcon = true;
        $takeEditAction = false;
        $takeDeleteAction = false;
        $takeAuditAction = false;

        $hide_retrieve_cols = [
                'country_id ',
                'application_class_enum ',
                'workflow_source_id ',
                'workflow_sub_scope_id ',
                'orgunit_id ',
                'employee_id ',
        ];

        if ($datatable_on) {
                include  dirname(__FILE__) . "/../lib/afw/modes/afw_handle_default_search.php";
                $collapse_in = '';
        } else
                $collapse_in = 'in';

        $wb_prefix = AfwLanguageHelper::tt('صندوق الوارد لـ', $lang, "workflow");

        $out_scr .= "<div class='workflow-title hzm-info'>$wb_prefix$employee_title</div>";

        if ($datatable_on) {
                if ($data_count > 0)
                        $out_scr .= $search_result_html;  // die("search_result_html=".$search_result_html); //
                else
                        $out_scr .= '<div class=\'workflow-information hzm-info\'>
        <i class="hzm-container-center hzm-vertical-align-middle hzm-icon-fm hzm-icon-inbox"></i>
        لا يوجد طلبات في ' . $result_page_title . '
        </div>';
        }
} catch (Exception $e) {
        $out_scr .= $e->getMessage() . "<br>\n" . $e->getFile() . ' Line ' . $e->getLine() . "<br>\n" . $e->getTraceAsString();
}
