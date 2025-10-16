<?php
if(!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::currentDBPrefix();
try
{
  
    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."workflow.`workflow_role` (
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
        role_category_enum smallint NOT NULL , 
        role_name_ar varchar(100)  NOT NULL , 
        role_name_en varchar(100)  NOT NULL , 
        role_description_ar varchar(100)  DEFAULT NULL , 
        role_description_en varchar(100)  DEFAULT NULL , 

        
        PRIMARY KEY (`id`)
        ) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");

    AfwDatabase::db_query("create unique index uk_workflow_role on ".$server_db_prefix."workflow.workflow_role(role_category_enum,role_name_ar,role_name_en);");

    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS nauss_workflow.`workflow_commitee` (
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
        
            
        commitee_name_ar varchar(100)  NOT NULL , 
        commitee_name_en varchar(100)  NOT NULL , 
        commitee_description_ar varchar(100)  DEFAULT NULL , 
        commitee_description_en varchar(100)  DEFAULT NULL , 
        workflow_role_id int(11) DEFAULT NULL , 
        secretary_employee_id  smallint DEFAULT NULL , 

        
        PRIMARY KEY (`id`)
        ) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");
    AfwDatabase::db_query("create unique index uk_workflow_commitee on ".$server_db_prefix."workflow.workflow_commitee(commitee_name_ar,commitee_name_en);");
    
    
    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."workflow.`workflow_task` (
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
    task_name_ar varchar(100)  NOT NULL , 
    task_name_en varchar(100)  NOT NULL , 
    task_description_ar varchar(100)  DEFAULT NULL , 
    task_description_en varchar(100)  DEFAULT NULL , 

    
    PRIMARY KEY (`id`)
    ) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");
     AfwDatabase::db_query("create unique index uk_workflow_task on ".$server_db_prefix."workflow.workflow_task(task_name_ar,task_name_en);");


    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."workflow.`workflow_commitee_member` (
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
    
        
    workflow_commitee_id int(11) NOT NULL , 
    workflow_employee_id int(11) NOT NULL , 

    
    PRIMARY KEY (`id`)
    ) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");

    AfwDatabase::db_query("create unique index uk_workflow_commitee_member on ".$server_db_prefix."workflow.workflow_commitee_member(workflow_commitee_id,workflow_employee_id);");


    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."workflow.`workflow_scope` (
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
        scope_name_ar varchar(100)  NOT NULL , 
        scope_name_en varchar(100)  NOT NULL , 
        scope_description_ar varchar(100)  DEFAULT NULL , 
        scope_description_en varchar(100)  DEFAULT NULL , 

        
        PRIMARY KEY (`id`)
        ) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");
    AfwDatabase::db_query("create unique index uk_workflow_scope on ".$server_db_prefix."workflow.workflow_scope(scope_name_ar,scope_name_en);");

    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."workflow.`workflow_commitee_scope` (
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
        
            
         `workflow_commitee_id` int(11) NOT NULL , 
         `workflow_scope_id` int(11) NOT NULL , 

        
        PRIMARY KEY (`id`)
        ) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");
    AfwDatabase::db_query("create unique index uk_workflow_commitee_scope on ".$server_db_prefix."workflow.workflow_commitee_scope(workflow_commitee_id,workflow_scope_id);");

}
catch(Exception $e)
{
    $migration_error .= " " . $e->getMessage();
}    