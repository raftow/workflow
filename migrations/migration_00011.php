<?php
if(!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::currentDBPrefix();
try
{
          

    
  
    
    AfwDatabase::db_query("DROP TABLE IF EXISTS ".$server_db_prefix."workflow.request_comment_subject;");
    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."workflow.`request_comment_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by` int(11) NOT NULL,
  `created_at`   datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `validated_by` int(11) DEFAULT NULL,
  `validated_at` datetime DEFAULT NULL,
  `active` char(1) NOT NULL,
  `draft` char(1) NOT NULL default  'Y' ,
  `version` int(4) DEFAULT NULL,
  `update_groups_mfk` varchar(255) DEFAULT NULL,
  `delete_groups_mfk` varchar(255) DEFAULT NULL,
  `display_groups_mfk` varchar(255) DEFAULT NULL,
  `sci_id` int(11) DEFAULT NULL,
    
   lookup_code varchar(16)  DEFAULT NULL , 
   name_ar varchar(128)  NOT NULL DEFAULT '' , 
   name_en varchar(128)  NOT NULL DEFAULT '' , 
   desc_ar text  DEFAULT NULL , 
   desc_en text  DEFAULT NULL , 
   workflow_stage_id int(11) NOT NULL DEFAULT 0 , 

  
  PRIMARY KEY (`id`)
) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");


AfwDatabase::db_query("create unique index uk_request_comment_subject on ".$server_db_prefix."workflow.request_comment_subject(lookup_code);");

  AfwDatabase::db_query("DROP TABLE IF EXISTS ".$server_db_prefix."workflow.workflow_request_comment;");

AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."workflow.`workflow_request_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by` int(11) NOT NULL,
  `created_at`   datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `validated_by` int(11) DEFAULT NULL,
  `validated_at` datetime DEFAULT NULL,
  `active` char(1) NOT NULL,
  `draft` char(1) NOT NULL default  'Y' ,
  `version` int(4) DEFAULT NULL,
  `update_groups_mfk` varchar(255) DEFAULT NULL,
  `delete_groups_mfk` varchar(255) DEFAULT NULL,
  `display_groups_mfk` varchar(255) DEFAULT NULL,
  `sci_id` int(11) DEFAULT NULL,
  
    
   workflow_request_id int(11) NOT NULL DEFAULT 0 , 
   Comment text default NULL , 
   request_comment_subject_id int(11) NOT NULL DEFAULT 0 , 
   Workflow_stage_id int(11) NOT NULL DEFAULT 0 , 

  
  PRIMARY KEY (`id`)
) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");

}
catch(Exception $e)
{
    $migration_error .= " " . $e->getMessage();
}    