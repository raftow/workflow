<?php
if (!class_exists("AfwSession")) die("Denied access");
/**
 * @var string $migration_error
 */
$server_db_prefix = AfwSession::currentDBPrefix();
try {

   /* AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request  add  aptitude_category_enum smallint DEFAULT 0  AFTER workflow_category_enum;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request_braudit  add  aptitude_category_enum smallint DEFAULT 0  AFTER workflow_category_enum;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "adm.program_requirement DROP INDEX `uk_program_requirement`;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "adm.program_requirement  add  aptitude_category_enum smallint DEFAULT 0  AFTER application_class_enum;");
    AfwDatabase::db_query("UPDATE " . $server_db_prefix . "adm.program_requirement  set  aptitude_category_enum = 0 where aptitude_category_enum is null;");
    AfwDatabase::db_query("CREATE UNIQUE INDEX uk_program_requirement on " . $server_db_prefix . "adm.program_requirement(academic_program_id,application_category_enum,application_class_enum,aptitude_category_enum);");
*/
    AfwAutoLoader::addMainModule('workflow');
    WorkflowRequest::repare_all_requests();
} catch (Exception $e) {
    $migration_error = " " . $e->getMessage();
}
