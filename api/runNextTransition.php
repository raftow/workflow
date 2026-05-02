<?php

$file_dir_name = dirname(__FILE__);
require_once("$file_dir_name/../../lib/afw/core/afw_autoloader.php");
include_once("$file_dir_name/../../lib/afw/utilities/ufw_error_handler.php");
set_time_limit(8400);
ini_set('error_reporting', E_ERROR | E_PARSE | E_RECOVERABLE_ERROR | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR);

AfwAutoLoader::addMainModule("adm");

include_once ("$file_dir_name/../adm/ini.php");
include_once ("$file_dir_name/../adm/module_config.php");
include_once ("$file_dir_name/../adm/application_config.php");
require_once("$file_dir_name/../../config/global_config.php");
AfwSession::initConfig($config_arr, "system", "$file_dir_name/../adm/application_config.php");

AfwSession::startSession();

$api_name = 'runNextTransition';
$data = [];

$workflow_request_id = trim($_POST['workflow_request_id']);
$transitionId        = trim($_POST['transitionId']);
$applicant_id        = trim($_POST['applicant_id']);
$lang                = trim($_POST['lang']) ?: 'ar';

if (!$workflow_request_id || !$transitionId || !$applicant_id) {
    $data['status']  = 'error';
    $data['message'] = "$api_name : required parameters missing"
        . " workflow_request_id=$workflow_request_id"
        . " transitionId=$transitionId"
        . " applicant_id=$applicant_id";
    die(json_encode($data));
}

//AfwSession::setUser($applicant_id);

$MODULE = 'workflow';
AfwAutoLoader::addMainModule($MODULE);

$reqObj = WorkflowRequest::loadById($workflow_request_id);

if (!$reqObj) {
    $data['status']  = 'error';
    $data['message'] = "$api_name : workflow request not found for id=$workflow_request_id";
    die(json_encode($data));
}

list($error, $status_comment) = $reqObj->runTransition($transitionId, $lang);

if ($error) {
    $data['status']  = 'error';
    $data['message'] = $error;
} else {
    $data['status']  = 'success';
    $data['message'] = $status_comment;
}

die(json_encode($data));
