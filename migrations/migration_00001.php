<?php
if(!class_exists("AfwSession")) die("Denied access");
$server_db_prefix = AfwSession::currentDBPrefix();


AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.`workflow_file` CHANGE `afile_size` `afile_size` INT(11) NULL DEFAULT NULL;");
AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.workflow_file add   owner_type varchar(32)  DEFAULT NULL  AFTER original_name");
AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.workflow_file add   owner_id int(11) DEFAULT NULL  AFTER owner_type");

AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.`workflow_file` CHANGE `afile_size` `afile_size` INT(11) NULL DEFAULT NULL;");
AfwDatabase::db_query("UPDATE ".$server_db_prefix."workflow.workflow_file set afile_size = afile_size + id;");
AfwDatabase::db_query("CREATE unique index uk_workflow_file on ".$server_db_prefix."workflow.workflow_file(original_name,owner_type,owner_id,afile_size);");
AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.`workflow_file` DROP INDEX `uk_adm_file`;");
AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.`workflow_file` CHANGE `owner_id` `owner_id` BIGINT(20) NULL DEFAULT NULL");