<?php
if(!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::currentDBPrefix();
try
{
    
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.interview_booking  add  reschedule_count smallint DEFAULT 0  AFTER can_reschedule_ind;");
    
}
catch(Exception $e)
{
    $migration_error .= " " . $e->getMessage();
}    