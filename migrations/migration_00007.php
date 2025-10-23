<?php
if(!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::currentDBPrefix();
try
{
  
    
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.workflow_commitee add   commitee_code varchar(16)  DEFAULT NULL  AFTER secretary_employee_id ;");
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.workflow_commitee DROP INDEX uk_workflow_commitee;");
    AfwDatabase::db_query("create unique index uk_workflow_commitee on ".$server_db_prefix."workflow.workflow_commitee(commitee_code);");
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.workflow_commitee_member DROP INDEX uk_workflow_commitee_member;");
    AfwDatabase::db_query("create unique index uk_workflow_commitee_member on ".$server_db_prefix."workflow.workflow_commitee_member(workflow_commitee_id,workflow_employee_id);");
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.workflow_model add   external_code varchar(32)  NOT NULL  AFTER application_field_mfk;");
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.workflow_model DROP INDEX uk_workflow_model;");
    AfwDatabase::db_query("create unique index uk_workflow_model on ".$server_db_prefix."workflow.workflow_model(external_code);");
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.workflow_role add   lookup_code varchar(16)  DEFAULT NULL  AFTER role_description_en;");
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.workflow_role DROP INDEX uk_workflow_role;");
    AfwDatabase::db_query("create unique index uk_workflow_role on ".$server_db_prefix."workflow.workflow_role(lookup_code);");
    
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.workflow_scope add   lookup_code varchar(16)  DEFAULT NULL  AFTER scope_description_en;");
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.workflow_scope DROP INDEX uk_workflow_scope;");

    AfwDatabase::db_query("create unique index uk_workflow_scope on ".$server_db_prefix."workflow.workflow_scope(lookup_code);");
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.workflow_status DROP INDEX uk_workflow_status;");
    
    AfwDatabase::db_query("create unique index uk_workflow_status on ".$server_db_prefix."workflow.workflow_status(workflow_model_id,status_code);");
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.workflow_task add   lookup_code varchar(16)  DEFAULT NULL  AFTER task_description_en;");
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.workflow_task DROP INDEX uk_workflow_task;");
    AfwDatabase::db_query("create unique index uk_workflow_task on ".$server_db_prefix."workflow.workflow_task(lookup_code);");
}
catch(Exception $e)
{
    $migration_error .= " " . $e->getMessage();
}    