<?php
if(!class_exists("AfwSession")) die("Denied access");
$server_db_prefix = AfwSession::config("db_prefix", "default_db_");

AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.workflow_file add   owner_type varchar(32)  DEFAULT NULL  AFTER original_name");
AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.workflow_file add   owner_id int(11) DEFAULT NULL  AFTER owner_type");