<?php
if(!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::currentDBPrefix();
try
{
  
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.workflow_stage change   standard_processing_time standard_processing_time smallint DEFAULT 0 AFTER required_application_field_mfk;");
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.workflow_stage change   processing_request_responsibility processing_request_responsibility smallint DEFAULT 0  AFTER time_unit;");

}
catch(Exception $e)
{
    $migration_error .= " " . $e->getMessage();
}    