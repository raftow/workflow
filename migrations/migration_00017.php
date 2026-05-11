<?php
if (!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::currentDBPrefix();
try {



AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_status add   sis_status_code varchar(16)  DEFAULT NULL  AFTER last_payment_deadline;");
} catch (Exception $e) {
    $migration_error = " " . $e->getMessage();
}
