<?php
if (!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::currentDBPrefix();
try {

    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_transition add notification_template_mfk  varchar(255) DEFAULT NULL  AFTER notification_template_id;");
} catch (Exception $e) {
    $migration_error = " " . $e->getMessage();
}
