<?php
if (!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::currentDBPrefix();
try {

    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.interview_type_pattern add   manual_booking_ind char(1) DEFAULT NULL  AFTER can_cancel_ind;");
} catch (Exception $e) {
    $migration_error = " " . $e->getMessage();
}
