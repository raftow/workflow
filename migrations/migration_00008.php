<?php
if(!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::currentDBPrefix();
try
{
  
    
    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."workflow.`workflow_module` (
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
    module_name_ar varchar(64)  NOT NULL DEFAULT '' , 
    module_name_en varchar(64)  DEFAULT NULL , 
    module_description_ar text  DEFAULT NULL , 
    module_description_en text  DEFAULT NULL ,

    
    PRIMARY KEY (`id`)
    ) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");

    AfwDatabase::db_query("create unique index uk_workflow_module on ".$server_db_prefix."workflow.workflow_module(lookup_code);");

    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."workflow.`workflow_entity` (
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

    workflow_module_id int(11) NOT NULL DEFAULT 0 , 
    entity_name_ar varchar(64)  NOT NULL DEFAULT '' , 
    entity_name_en varchar(64)  DEFAULT NULL , 
    entity_description_ar text  DEFAULT NULL , 
    entity_description_en text  DEFAULT NULL , 

    
    PRIMARY KEY (`id`)
    ) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");

    AfwDatabase::db_query("create unique index uk_workflow_entity on ".$server_db_prefix."workflow.workflow_entity(lookup_code);");
    
    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."workflow.`workflow_event` (
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
   workflow_module_id int(11) NOT NULL DEFAULT 0 , 
   workflow_entity_id int(11) NOT NULL DEFAULT 0 , 
   event_name_ar varchar(64)  NOT NULL DEFAULT '' , 
   event_name_en varchar(64)  DEFAULT NULL , 
   event_description_ar text  DEFAULT NULL , 
   event_description_en text  DEFAULT NULL , 

  
  PRIMARY KEY (`id`)
) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");

    AfwDatabase::db_query("create unique index uk_workflow_event on ".$server_db_prefix."workflow.workflow_event(lookup_code);");

    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."workflow.`notification_template` (
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
        
            
        workflow_module_id int(11) NOT NULL , 
        workflow_entity_id int(11) NOT NULL , 
        notification_title varchar(64)  NOT NULL DEFAULT '' , 
        notification_body text  DEFAULT NULL , 

        
        PRIMARY KEY (`id`)
        ) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");

    AfwDatabase::db_query("create unique index uk_notification_template on ".$server_db_prefix."workflow.notification_template(workflow_module_id,workflow_entity_id);");
    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."workflow.`notification_schedule` (
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
    
        
    workflow_module_id int(11) NOT NULL , 
    workflow_entity_id int(11) NOT NULL , 
    workflow_event_id int(11) DEFAULT NULL , 
    notification_template_id int(11) DEFAULT NULL , 

    
    PRIMARY KEY (`id`)
    ) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");

    AfwDatabase::db_query("create unique index uk_notification_schedule on ".$server_db_prefix."workflow.notification_schedule(workflow_module_id,workflow_entity_id,workflow_event_id,notification_template_id);");
    
    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."workflow.`notification` (
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
    
        
    workflow_module_id int(11) NOT NULL , 
    workflow_entity_id int(11) NOT NULL , 
    destination_id int(11) DEFAULT NULL , 
    notification_template_id int(11) DEFAULT NULL , 
    workflow_event_id int(11) DEFAULT NULL , 
    event_date datetime DEFAULT NULL , 
    email varchar(25)  DEFAULT NULL , 
    mobile varchar(25)  DEFAULT NULL , 
    notification_title varchar(64)  DEFAULT NULL , 
    notification_body text  DEFAULT NULL , 
    sent char(1) DEFAULT NULL , 
    sent_date datetime DEFAULT NULL , 
    received char(1) DEFAULT NULL , 
    received_date datetime DEFAULT NULL , 
    `read` char(1) DEFAULT NULL , 
    read_date datetime DEFAULT NULL , 

    
    PRIMARY KEY (`id`)
    ) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");

    
    AfwDatabase::db_query("create unique index uk_notification on ".$server_db_prefix."workflow.notification(workflow_module_id,workflow_entity_id,destination_id,notification_template_id,workflow_event_id,event_date);");
    
}
catch(Exception $e)
{
    $migration_error .= " " . $e->getMessage();
}    