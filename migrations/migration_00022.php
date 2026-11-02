<?php
if (!class_exists("AfwSession")) die("Denied access");
/**
 * @var string $migration_error
 */
$server_db_prefix = AfwSession::currentDBPrefix();
try {
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request_braudit add original_copied_1 text;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request_braudit  add original_copied_2 text;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request_braudit  add original_copied_3 text;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request_braudit  add original_copied_4 text;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request_braudit  add original_copied_5 text;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request_braudit  add original_copied_6 text;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request_braudit  add original_copied_7 text;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request_braudit  add original_copied_8 text;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request_braudit  add original_copied_9 text;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request_braudit  add original_copied_10 text;");

    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request  add original_copied_1 text;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request  add original_copied_2 text;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request  add original_copied_3 text;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request  add original_copied_4 text;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request  add original_copied_5 text;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request  add original_copied_6 text;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request  add original_copied_7 text;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request  add original_copied_8 text;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request  add original_copied_9 text;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request  add original_copied_10 text;");
} catch (Exception $e) {
    $migration_error = " " . $e->getMessage();
}
