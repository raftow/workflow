<?php
if (!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::currentDBPrefix();
try {



AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS " . $server_db_prefix . "workflow.`workflow_request_braudit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by` int(11) NOT NULL,
  `created_at`   datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `validated_by` int(11) DEFAULT NULL,
  `validated_at` datetime DEFAULT NULL,
  `active` char(1) NOT NULL,
  `draft` char(1) NOT NULL default  'Y',
  `version` int(4) NOT NULL,
  `update_groups_mfk` varchar(255) DEFAULT NULL,
  `delete_groups_mfk` varchar(255) DEFAULT NULL,
  `display_groups_mfk` varchar(255) DEFAULT NULL,
  `sci_id` int(11) DEFAULT NULL,
  
    
   workflow_applicant_id int(11) NOT NULL , 
   idn varchar(32)  NOT NULL DEFAULT '' , 
   application_class_enum smallint NOT NULL DEFAULT 0 , 
   workflow_category_enum smallint NOT NULL DEFAULT 0 , 
   workflow_model_id int(11) NOT NULL , 
   workflow_session_id int(11) NOT NULL DEFAULT 0 , 
   workflow_source_id int(11) NOT NULL DEFAULT 0 , 
   workflow_scope_id int(11) NOT NULL DEFAULT 0 , 
   workflow_sub_scope_id int(11) NOT NULL DEFAULT 0 , 
   workflow_stage_id int(11) NOT NULL DEFAULT 0 , 
   workflow_status_id int(11) NOT NULL DEFAULT 0 , 
   external_request_code varchar(64)  NOT NULL DEFAULT '' , 
   request_type_code varchar(32)  NOT NULL DEFAULT '' , 
   request_date varchar(8) NOT NULL DEFAULT '14000101' , 
   orgunit_id int(11) NOT NULL DEFAULT 0 , 
   employee_id int(11) DEFAULT NULL , 
   assign_date varchar(8) DEFAULT NULL , 
   assign_time varchar(8) DEFAULT NULL , 
   attempt char(1) DEFAULT NULL , 
   done char(1) DEFAULT NULL , 
   done_date datetime DEFAULT NULL , 
   done_time varchar(8) DEFAULT NULL , 
   interview_score decimal(5,2) DEFAULT NULL , 
   workflow_rejection_reason_id int(11) DEFAULT NULL , 

        action VARCHAR(24) NOT NULL,  
        action_by INT(11) NOT NULL,   
        action_at DATETIME NOT NULL,    
        action_browser VARCHAR(255) NOT NULL,    
        action_ip VARCHAR(24) NOT NULL,  
        update_context VARCHAR(64) NOT NULL, 
  
  PRIMARY KEY (id,version,action)
) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");



AfwDatabase::db_query("create unique index uk_workflow_request_braudit on " . $server_db_prefix . "workflow.workflow_request_braudit(workflow_applicant_id,workflow_model_id,version,action);");
} catch (Exception $e) {
    $migration_error = " " . $e->getMessage();
}
