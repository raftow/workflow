<?php
if (!class_exists("AfwSession")) die("Denied access");
/**
 * @var string $migration_error
 */
$server_db_prefix = AfwSession::currentDBPrefix();
try {
    AfwAutoLoader::addMainModule('workflow');
    WorkflowRequest::repare_all_requests();
} catch (Exception $e) {
    $migration_error = " " . $e->getMessage();
}
