<?php
if (!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::currentDBPrefix();
try {

    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_transition  add  next_transition_id int(11) NOT NULL DEFAULT 0  AFTER notification_template_id;");
} catch (Exception $e) {
    $migration_error .= " " . $e->getMessage();
}
