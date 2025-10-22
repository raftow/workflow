<?php
if(!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::currentDBPrefix();
try
{
  
    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."workflow.`workflow_model` (
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
  
    
   workflow_model_name_ar varchar(100)  NOT NULL , 
   workflow_model_name_en varchar(100)  NOT NULL DEFAULT '' , 
   workflow_model_desc_ar text  DEFAULT NULL , 
   workflow_model_desc_en text  DEFAULT NULL , 
   application_field_mfk smallint DEFAULT NULL , 

  
  PRIMARY KEY (`id`)
) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");

    
AfwDatabase::db_query("create unique index uk_workflow_model on ".$server_db_prefix."workflow.workflow_model(workflow_model_name_ar);");

    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."workflow.`workflow_stage` (
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
  
    
   workflow_model_id int(11) NOT NULL , 
   workflow_stage_name_ar varchar(100)  NOT NULL DEFAULT '' , 
   workflow_stage_name_en varchar(100)  DEFAULT NULL , 
   workflow_stage_desc_ar text  DEFAULT NULL , 
   workflow_stage_desc_en text  DEFAULT NULL , 
   step_code varchar(16)  DEFAULT NULL , 
   required_application_field_mfk smallint DEFAULT NULL , 

   standard_processing_time smallint DEFAULT NULL , 
   time_unit smallint DEFAULT NULL , 
   processing_request_responsibility varchar(100)  DEFAULT NULL ,  
   workflow_role_id int(11) DEFAULT NULL , 
  
  PRIMARY KEY (`id`)
) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");
    
AfwDatabase::db_query("create unique index uk_workflow_stage on ".$server_db_prefix."workflow.workflow_stage(workflow_model_id,workflow_stage_name_ar,workflow_stage_name_en);");
    
    
    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."workflow.`workflow_status` (
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
  
  `lookup_code` varchar(64) DEFAULT NULL,  
   workflow_model_id int(11) DEFAULT NULL , 
   workflow_status_name_ar varchar(100)  NOT NULL DEFAULT '' , 
   workflow_status_name_en varchar(100)  DEFAULT NULL , 
   workflow_status_desc_ar text  DEFAULT NULL , 
   workflow_status_desc_en text  DEFAULT NULL , 
   status_code varchar(16)  DEFAULT NULL , 
   
   workflow_stage_id int(11) DEFAULT NULL , 
   interview_invite_ind char(1) DEFAULT NULL , 
   is_final char(1) DEFAULT NULL , 
   payment_ind char(1) DEFAULT NULL , 
   web_ind char(1) DEFAULT NULL , 
   applicant_can_cancel char(1) DEFAULT NULL , 
  
  PRIMARY KEY (`id`)
) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");
    
AfwDatabase::db_query("create unique index uk_workflow_status on ".$server_db_prefix."workflow.workflow_status(workflow_model_id,workflow_status_name_ar,workflow_status_name_en);");


AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."workflow.`workflow_request` (
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
  
    
   workflow_applicant_id int(11) NOT NULL , 
   workflow_model_id int(11) NOT NULL , 
   workflow_stage_id int(11) DEFAULT NULL , 
   workflow_status_id int(11) DEFAULT NULL , 
   external_request_code varchar(64)  DEFAULT NULL , 
   request_type_code varchar(32)  DEFAULT NULL , 

  
  PRIMARY KEY (`id`)
) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");




AfwDatabase::db_query("create unique index uk_workflow_request on ".$server_db_prefix."workflow.workflow_request(workflow_applicant_id,workflow_model_id);");


AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."workflow.`workflow_request_data` (
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
  
    
   workflow_request_id int(11) NOT NULL , 
   application_field_id int(11) NOT NULL , 
   field_value text  DEFAULT NULL , 

  
  PRIMARY KEY (`id`)
) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");

AfwDatabase::db_query("create unique index uk_workflow_request_data on ".$server_db_prefix."workflow.workflow_request_data(workflow_request_id,application_field_id);");

    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."workflow.`workflow_action` (
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
  
    
   workflow_model_id int(11) DEFAULT NULL , 
   workflow_action_name_ar varchar(100)  DEFAULT NULL , 
   workflow_action_name_en varchar(100)  DEFAULT NULL , 
   action_type_enum smallint NOT NULL DEFAULT 0 , 
   workflow_action_desc_ar text  DEFAULT NULL , 
   workflow_action_desc_en text  DEFAULT NULL , 
   comments_mandatory char(1) DEFAULT NULL , 
   workflow_stage_id int(11) DEFAULT NULL , 

  
  PRIMARY KEY (`id`)
) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");

AfwDatabase::db_query("create unique index uk_workflow_action on ".$server_db_prefix."workflow.workflow_action(workflow_model_id,workflow_action_name_ar,workflow_stage_id);");

    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."workflow.`workflow_rejection_reason` (
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
  
  `lookup_code` varchar(64) DEFAULT NULL,  
   rejection_reason_ar varchar(100)  NOT NULL DEFAULT '' , 
   rejection_reason_en varchar(100)  DEFAULT NULL , 
   workflow_stage_id int(11) DEFAULT NULL , 

  
  PRIMARY KEY (`id`)
) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1");

}
catch(Exception $e)
{
    $migration_error .= " " . $e->getMessage();
}    