<?php

$file_dir_name = dirname(__FILE__);
require_once ("$file_dir_name/../../lib/afw/afw_autoloader.php");
include_once ("$file_dir_name/../../lib/afw/afw_error_handler.php");
set_time_limit(8400);
ini_set('error_reporting', E_ERROR | E_PARSE | E_RECOVERABLE_ERROR | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR);
$lang = 'en';

AfwSession::startSession();
$update_context = 'save new comment for workflow request';
// echo "here5";
require_once ("$file_dir_name/../../config/global_config.php");
// echo "here6";
// old include of afw.php
$only_members = true;
$api_name = 'wkf add comment';
// echo "here4";

$idreq = trim($_POST['idreq']);
$subject = trim($_POST['subject']);
$comment = trim($_POST['comment']);
$stage = trim($_POST['stage']);

$data = [];

if ((!$idreq) or (!$subject) or (!$comment) or (!$stage)) {
    $data['status'] = 'error';
    $data['message'] = "$api_name error : attributes required missed idreq=$idreq subject=$subject comment=$comment stage=$stage";
    die(json_encode($data));
}

$MODULE = 'workflow';
include ("$file_dir_name/../lib/afw/afw_check_member.php");
$lang = AfwLanguageHelper::getGlobalLanguage();

// echo "here3";
AfwAutoLoader::addMainModule($MODULE);

/*
 * $required_modules = AfwSession::config('required_modules', []);
 * foreach ($required_modules as $required_module) {
 *     AfwAutoLoader::addModule($required_module);
 * }
 */

/** @var WorkflowRequestComment $reqObj */
$reqCommentObj = new WorkflowRequestComment();

$reqObj = WorkflowRequest::loadById($idreq);

if (!$reqObj) {
    $data['status'] = 'error';
    $data['message'] = $reqCommentObj->tm('OBJECT_NOT_FOUND', $lang) . " : idreq=$idreq";
    die(json_encode($data));
}

list($can_edit_me, $can_t_edit_me_reason) = $reqCommentObj->userCanEditMe($objme);
if (!$can_edit_me) {
    $data['status'] = 'error';
    $data['message'] = 'المعذرة هذه العملية للتعديل على هذا السجل تحتاج صلاحية : ' . $can_t_edit_me_reason;
}

$reqCommentObj->set('workflow_request_id', $idreq);
$reqCommentObj->set('workflow_stage_id', $stage);
$reqCommentObj->set('request_comment_subject_id', $subject);
$reqCommentObj->set('comment', $comment);
$done = $reqCommentObj->commit();

if ($done) {
    $data['status'] = 'success';
    $data['message'] = '';
    $data['aff'] = [
        'id' => $reqCommentObj->id,
        'stage' => $reqCommentObj->decode('workflow_stage_id', '', false, $lang),
        'subject' => $reqCommentObj->decode('request_comment_subject_id', '', false, $lang),
        'comment' => $reqCommentObj->getVal('comment'),
    ];
} else {
    $data['status'] = 'fail';
    $data['message'] = 'check the beforeUpdate/beforeMaj methods in WorkflowRequestComment, because the update has been rejected';
}

die(json_encode($data));
