<?php
if (!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::currentDBPrefix();
$db_prefix = $server_db_prefix . "workflow";
try {

    AfwDatabase::db_query("DROP TABLE IF EXISTS $db_prefix.workflow_source;");

    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS $db_prefix.`workflow_source` (
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
   lookup_code varchar(16)  NOT NULL , 
   source_name_ar varchar(100)  NOT NULL DEFAULT '' , 
   source_name_en varchar(100)  NOT NULL DEFAULT '' , 
   source_description_ar varchar(100)  DEFAULT NULL , 
   source_description_en varchar(100)  DEFAULT NULL , 

  
  PRIMARY KEY (`id`)
) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");



    // -- unique index : 
    AfwDatabase::db_query("CREATE UNIQUE INDEX uk_workflow_source on $db_prefix.workflow_source(workflow_module_id,lookup_code);");

    AfwDatabase::db_query("ALTER TABLE $db_prefix.workflow_request add   workflow_source_id int(11) NOT NULL DEFAULT 0  AFTER workflow_session_id;");

    AfwDatabase::db_query("ALTER TABLE $db_prefix.workflow_request add   workflow_sub_scope_id int(11) NOT NULL DEFAULT 0  AFTER workflow_scope_id;");
    //AfwDatabase::db_query("DROP TABLE IF EXISTS " . $server_db_prefix . "workflow.workflow_sub_scope;");

    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS " . $server_db_prefix . "workflow.`workflow_sub_scope` (
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
   workflow_scope_id int(11) NOT NULL , 
   lookup_code varchar(16)  NOT NULL , 
   sub_scope_name_ar varchar(100)  NOT NULL DEFAULT '' , 
   sub_scope_name_en varchar(100)  NOT NULL DEFAULT '' , 
   sub_scope_description_ar varchar(100)  DEFAULT NULL , 
   sub_scope_description_en varchar(100)  DEFAULT NULL , 

  
  PRIMARY KEY (`id`)
) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");


    // -- unique index : 
    AfwDatabase::db_query("create unique index uk_workflow_sub_scope on " . $server_db_prefix . "workflow.workflow_sub_scope(workflow_module_id,workflow_scope_id,lookup_code);");


    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_stage  add  color_enum smallint DEFAULT 10  AFTER interview_ind;");
    AfwDatabase::db_query("UPDATE      " . $server_db_prefix . "workflow.workflow_stage  set color_enum=10;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request add   interview_score decimal(5,2) DEFAULT NULL  AFTER done_date;");
    AfwDatabase::db_query("CREATE UNIQUE INDEX pk2_interview_type_pattern on " . $server_db_prefix . "workflow.interview_type_pattern(workflow_stage_id);");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request  add  application_class_enum smallint DEFAULT 0  AFTER workflow_applicant_id;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request  add  workflow_category_enum smallint DEFAULT 0  AFTER application_class_enum;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.interview_booking  add  reschedule_count smallint DEFAULT 0  AFTER can_reschedule_ind;");
} catch (Exception $e) {
    $migration_error .= " " . $e->getMessage();
}
