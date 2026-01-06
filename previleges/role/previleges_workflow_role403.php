<?php

$role_info[403] = array(
  'code' => 'goal-requests',
  'name' =>
  array(
    'ar' => 'ادارة الطلبات',
    'en' => 'Requests management',
  ),
  'menu' =>
  array(
    'need_admin' => false,
    'id' => '403',
    'menu_name_' => 'ادارة الطلبات',
    'menu_name_ar' => 'ادارة الطلبات',
    'menu_name_en' => 'Requests management',
    'page' => 'main.php?Main_Page=fm.php&a=1283&r=403',
    'css' => 'info',
    'icon' => ' icon-403',
    'showme' => true,
    'items' =>
    array(
      105254 =>
      array(
        'id' => '105254',
        'code' => 'inbox',
        'level' => '999',
        'menu_name_ar' => 'صندوق الوارد',
        'menu_name_en' => 'Inbox',
        'page' => 'main.php?Main_Page=inbox.php',
        'css' => 'bf',
        'icon' => 'bficon-105254 bfc-',
      ),
      105253 =>
      array(
        'id' => '105253',
        'code' => 'f2-a-workflow_request_data/qsearch',
        'level' => '1',
        'menu_name_ar' => 'بيانات طلبات',
        'menu_name_en' => 'Workflow request datas',
        'page' => 'main.php?Main_Page=afw_mode_qsearch.php&cl=WorkflowRequestData&currmod=workflow',
        'css' => 'bf',
        'icon' => 'bficon-105253 bfc-',
      ),
      105247 =>
      array(
        'id' => '105247',
        'code' => 'f2-a-workflow_request/qsearch',
        'level' => '999',
        'menu_name_ar' => 'طلبات القبول',
        'menu_name_en' => 'Workflow requests',
        'page' => 'main.php?Main_Page=afw_mode_qsearch.php&cl=WorkflowRequest&currmod=workflow',
        'css' => 'bf',
        'icon' => 'bficon-105247 bfc-',
      ),
      105290 =>
      array(
        'id' => '105290',
        'code' => 'f2-a-workflow_request_comment/qsearch',
        'level' => '1',
        'menu_name_ar' => 'التعليقات والملاحظات',
        'menu_name_en' => 'Workflow session',
        'page' => 'main.php?Main_Page=afw_mode_qsearch.php&cl=WorkflowRequestComment&currmod=workflow',
        'css' => 'bf',
        'icon' => 'bficon-105290 bfc-',
      ),
    ),
    'otherbfs' =>
    array(
      105242 =>
      array(
        'id' => '105242',
        'code' => 'f2-a-workflow_request/edit',
        'level' => '999',
        'menu_name_ar' => 'إنشاء طلب قبول',
        'menu_name_en' => 'create Workflow request',
        'page' => 'main.php?Main_Page=afw_mode_edit.php&cl=WorkflowRequest&currmod=workflow',
        'css' => 'bf',
        'icon' => 'bficon-105242 bfc-',
      ),
      105244 =>
      array(
        'id' => '105244',
        'code' => 'f2-a-workflow_request/delete',
        'level' => '999',
        'menu_name_ar' => 'مسح طلب قبول',
        'menu_name_en' => 'delete Workflow request',
        'page' => 'main.php?Main_Page=afw_mode_delete.php&cl=WorkflowRequest&currmod=workflow',
        'css' => 'bf',
        'icon' => 'bficon-105244 bfc-',
      ),
      105245 =>
      array(
        'id' => '105245',
        'code' => 'f2-a-workflow_request/display',
        'level' => '999',
        'menu_name_ar' => 'عرض تفاصيل طلب قبول',
        'menu_name_en' => 'display details of Workflow request',
        'page' => 'main.php?Main_Page=afw_mode_display.php&cl=WorkflowRequest&currmod=workflow',
        'css' => 'bf',
        'icon' => 'bficon-105245 bfc-',
      ),
      105246 =>
      array(
        'id' => '105246',
        'code' => 'f2-a-workflow_request/search',
        'level' => '999',
        'menu_name_ar' => 'البحث في طلبات القبول',
        'menu_name_en' => 'Workflow requests search',
        'page' => 'main.php?Main_Page=afw_mode_search.php&cl=WorkflowRequest&currmod=workflow',
        'css' => 'bf',
        'icon' => 'bficon-105246 bfc-',
      ),
      105247 =>
      array(
        'id' => '105247',
        'code' => 'f2-a-workflow_request/qsearch',
        'level' => '999',
        'menu_name_ar' => 'طلبات القبول',
        'menu_name_en' => 'Workflow requests',
        'page' => 'main.php?Main_Page=afw_mode_qsearch.php&cl=WorkflowRequest&currmod=workflow',
        'css' => 'bf',
        'icon' => 'bficon-105247 bfc-',
      ),
      105248 =>
      array(
        'id' => '105248',
        'code' => 'f2-a-workflow_request_data/edit',
        'level' => '1',
        'menu_name_ar' => 'إنشاء بيانات طلب',
        'menu_name_en' => 'create Workflow request data',
        'page' => 'main.php?Main_Page=afw_mode_edit.php&cl=WorkflowRequestData&currmod=workflow',
        'css' => 'bf',
        'icon' => 'bficon-105248 bfc-',
      ),
      105250 =>
      array(
        'id' => '105250',
        'code' => 'f2-a-workflow_request_data/delete',
        'level' => '1',
        'menu_name_ar' => 'مسح بيانات طلب',
        'menu_name_en' => 'delete Workflow request data',
        'page' => 'main.php?Main_Page=afw_mode_delete.php&cl=WorkflowRequestData&currmod=workflow',
        'css' => 'bf',
        'icon' => 'bficon-105250 bfc-',
      ),
      105251 =>
      array(
        'id' => '105251',
        'code' => 'f2-a-workflow_request_data/display',
        'level' => '1',
        'menu_name_ar' => 'عرض تفاصيل بيانات طلب',
        'menu_name_en' => 'display details of Workflow request data',
        'page' => 'main.php?Main_Page=afw_mode_display.php&cl=WorkflowRequestData&currmod=workflow',
        'css' => 'bf',
        'icon' => 'bficon-105251 bfc-',
      ),
      105252 =>
      array(
        'id' => '105252',
        'code' => 'f2-a-workflow_request_data/search',
        'level' => '1',
        'menu_name_ar' => 'البحث في بيانات طلبات',
        'menu_name_en' => 'Workflow request datas search',
        'page' => 'main.php?Main_Page=afw_mode_search.php&cl=WorkflowRequestData&currmod=workflow',
        'css' => 'bf',
        'icon' => 'bficon-105252 bfc-',
      ),
      105253 =>
      array(
        'id' => '105253',
        'code' => 'f2-a-workflow_request_data/qsearch',
        'level' => '1',
        'menu_name_ar' => 'بيانات طلبات',
        'menu_name_en' => 'Workflow request datas',
        'page' => 'main.php?Main_Page=afw_mode_qsearch.php&cl=WorkflowRequestData&currmod=workflow',
        'css' => 'bf',
        'icon' => 'bficon-105253 bfc-',
      ),
      105254 =>
      array(
        'id' => '105254',
        'code' => 'inbox',
        'level' => '999',
        'menu_name_ar' => 'صندوق الوارد',
        'menu_name_en' => 'Inbox',
        'page' => 'main.php?Main_Page=inbox.php',
        'css' => 'bf',
        'icon' => 'bficon-105254 bfc-',
      ),
      105285 =>
      array(
        'id' => '105285',
        'code' => 'f2-a-workflow_request_comment/edit',
        'level' => '1',
        'menu_name_ar' => 'إنشاء تعليق أوملاحظة',
        'menu_name_en' => 'create Workflow session',
        'page' => 'main.php?Main_Page=afw_mode_edit.php&cl=WorkflowRequestComment&currmod=workflow',
        'css' => 'bf',
        'icon' => 'bficon-105285 bfc-',
      ),
      105287 =>
      array(
        'id' => '105287',
        'code' => 'f2-a-workflow_request_comment/delete',
        'level' => '1',
        'menu_name_ar' => 'مسح تعليق أوملاحظة',
        'menu_name_en' => 'delete Workflow session',
        'page' => 'main.php?Main_Page=afw_mode_delete.php&cl=WorkflowRequestComment&currmod=workflow',
        'css' => 'bf',
        'icon' => 'bficon-105287 bfc-',
      ),
      105288 =>
      array(
        'id' => '105288',
        'code' => 'f2-a-workflow_request_comment/display',
        'level' => '1',
        'menu_name_ar' => 'عرض تفاصيل تعليق أوملاحظة',
        'menu_name_en' => 'display details of Workflow session',
        'page' => 'main.php?Main_Page=afw_mode_display.php&cl=WorkflowRequestComment&currmod=workflow',
        'css' => 'bf',
        'icon' => 'bficon-105288 bfc-',
      ),
      105289 =>
      array(
        'id' => '105289',
        'code' => 'f2-a-workflow_request_comment/search',
        'level' => '1',
        'menu_name_ar' => 'البحث في التعليقات والملاحظات',
        'menu_name_en' => 'Workflow session search',
        'page' => 'main.php?Main_Page=afw_mode_search.php&cl=WorkflowRequestComment&currmod=workflow',
        'css' => 'bf',
        'icon' => 'bficon-105289 bfc-',
      ),
      105290 =>
      array(
        'id' => '105290',
        'code' => 'f2-a-workflow_request_comment/qsearch',
        'level' => '1',
        'menu_name_ar' => 'التعليقات والملاحظات',
        'menu_name_en' => 'Workflow session',
        'page' => 'main.php?Main_Page=afw_mode_qsearch.php&cl=WorkflowRequestComment&currmod=workflow',
        'css' => 'bf',
        'icon' => 'bficon-105290 bfc-',
      ),
    ),
    'sub-folders' =>
    array(),
  ),
);
