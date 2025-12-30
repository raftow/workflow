<?php
if(!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::currentDBPrefix();
try
{
          

    
  
    
    
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.interview_booking add   workflow_request_id int(11) NOT NULL DEFAULT 0  AFTER workflow_session_id;");
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.interview_booking add   workflow_scope_id int(11) NOT NULL DEFAULT 0  AFTER workflow_request_id;");

}
catch(Exception $e)
{
    $migration_error .= " " . $e->getMessage();
}    