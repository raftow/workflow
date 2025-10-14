<?php
if(!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::currentDBPrefix();
try
{
  
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.workflow_file add   stored_file_name varchar(256)  DEFAULT NULL  AFTER afile_size;");

    
}
catch(Exception $e)
{
    $migration_error .= " " . $e->getMessage();
}    