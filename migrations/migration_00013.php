<?php
if (!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::currentDBPrefix();
try {

    AfwDatabase::db_query("CREATE UNIQUE INDEX pk2_interview_type_pattern on " . $server_db_prefix . "workflow.interview_type_pattern(workflow_stage_id);");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request  add  application_class_enum smallint DEFAULT 0  AFTER workflow_applicant_id;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request  add  workflow_category_enum smallint DEFAULT 0  AFTER application_class_enum;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.interview_booking  add  reschedule_count smallint DEFAULT 0  AFTER can_reschedule_ind;");
} catch (Exception $e) {
    $migration_error .= " " . $e->getMessage();
}
