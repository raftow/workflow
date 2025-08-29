<?php
if(!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::currentDBPrefix();
try
{
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."bau.`goal_concern`
      CHANGE `orgunit_id` `orgunit_id` int NULL AFTER `goal_id`,
      CHANGE `jobsdd_id` `jobsdd_id` int NULL AFTER `orgunit_id`,
      CHANGE `application_id` `application_id` int NULL AFTER `comment`,
      CHANGE `atable_mfk` `atable_mfk` varchar(255) COLLATE 'utf8mb3_unicode_ci' NULL AFTER `application_id`,
      CHANGE `operation_men` `operation_men` varchar(255) COLLATE 'utf8mb3_unicode_ci' NULL AFTER `atable_mfk`;");

    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."bau.`user_story`
      CHANGE `user_story_name_ar` `user_story_name_ar` varchar(128) COLLATE 'utf8mb3_unicode_ci' NULL AFTER `user_story_goal_id`,
      CHANGE `user_story_name_en` `user_story_name_en` varchar(128) COLLATE 'utf8mb3_unicode_ci' NULL AFTER `user_story_name_ar`;");

    
}
catch(Exception $e)
{
    $migration_error .= " " . $e->getMessage();
}    