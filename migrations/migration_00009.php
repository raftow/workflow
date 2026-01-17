<?php
if (!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::currentDBPrefix();
try {
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_applicant add `birth_gdate` date DEFAULT NULL after gender_enum;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_role CHANGE `role_category_enum` `role_category_enum` smallint NOT NULL DEFAULT '0' AFTER `lookup_code`;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_stage add   orgunit_id int(11) NOT NULL DEFAULT 0  AFTER workflow_stage_desc_en;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request add   attempt char(1) NOT NULL DEFAULT 'N'  AFTER workflow_status_id;");

    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_stage add   interview_ind char(1) NOT NULL DEFAULT 'W'  AFTER workflow_role_id;");
} catch (Exception $e) {
    $migration_error .= " " . $e->getMessage();
}
