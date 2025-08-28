<?php
if(!class_exists("AfwSession")) die("Denied access");
$server_db_prefix = AfwSession::currentDBPrefix();

ALTER TABLE `goal_concern`
CHANGE `orgunit_id` `orgunit_id` int NULL AFTER `goal_id`,
CHANGE `jobsdd_id` `jobsdd_id` int NULL AFTER `orgunit_id`,
CHANGE `application_id` `application_id` int NULL AFTER `comment`,
CHANGE `atable_mfk` `atable_mfk` varchar(255) COLLATE 'utf8mb3_unicode_ci' NULL AFTER `application_id`,
CHANGE `operation_men` `operation_men` varchar(255) COLLATE 'utf8mb3_unicode_ci' NULL AFTER `atable_mfk`;

ALTER TABLE `user_story`
CHANGE `user_story_name_ar` `user_story_name_ar` varchar(128) COLLATE 'utf8mb3_unicode_ci' NULL AFTER `user_story_goal_id`,
CHANGE `user_story_name_en` `user_story_name_en` varchar(128) COLLATE 'utf8mb3_unicode_ci' NULL AFTER `user_story_name_ar`;

AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.`workflow_file` CHANGE `afile_size` `afile_size` INT(11) NULL DEFAULT NULL;");
AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.workflow_file add   owner_type varchar(32)  DEFAULT NULL  AFTER original_name");
AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.workflow_file add   owner_id int(11) DEFAULT NULL  AFTER owner_type");

AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.`workflow_file` CHANGE `afile_size` `afile_size` INT(11) NULL DEFAULT NULL;");
AfwDatabase::db_query("UPDATE ".$server_db_prefix."workflow.workflow_file set afile_size = afile_size + id;");
AfwDatabase::db_query("CREATE unique index uk_workflow_file on ".$server_db_prefix."workflow.workflow_file(original_name,owner_type,owner_id,afile_size);");
AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.`workflow_file` DROP INDEX `uk_adm_file`;");
AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."workflow.`workflow_file` CHANGE `owner_id` `owner_id` BIGINT(20) NULL DEFAULT NULL");