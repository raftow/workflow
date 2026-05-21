<?php
if (!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::currentDBPrefix();
try {
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.interview_slot add workflow_session_id int(11) NOT NULL DEFAULT 0;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.interview_slot add interview_type_pattern_id int(11) NOT NULL DEFAULT 0;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.interview_slot add workflow_scope_id int(11) NOT NULL DEFAULT 0;");
    AfwDatabase::db_query("UPDATE " . $server_db_prefix . "workflow.interview_slot isl set isl.interview_type_pattern_id = (select interview_type_pattern_id from " . $server_db_prefix . "workflow.slot_model where id = isl.slot_model_id);");
    AfwDatabase::db_query("UPDATE " . $server_db_prefix . "workflow.interview_slot isl set isl.workflow_session_id = (select workflow_session_id from " . $server_db_prefix . "workflow.slot_model where id = isl.slot_model_id);");
    AfwDatabase::db_query("UPDATE " . $server_db_prefix . "workflow.interview_slot isl set isl.workflow_scope_id = (select workflow_scope_id from " . $server_db_prefix . "workflow.slot_model where id = isl.slot_model_id);");

    AfwDatabase::db_query("UPDATE " . $server_db_prefix . "workflow.interview_booking set workflow_scope_id = 0 where interview_type_pattern_id in (select id from " . $server_db_prefix . "workflow.interview_type_pattern where booking_program_ind = 'N');");
} catch (Exception $e) {
    $migration_error = " " . $e->getMessage();
}
