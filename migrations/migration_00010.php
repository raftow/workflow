<?php
if(!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::currentDBPrefix();
try
{
          

    
  
    AfwDatabase::db_query("DROP TABLE IF EXISTS ".$server_db_prefix."workflow.interview_type_pattern;");

    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."workflow.`interview_type_pattern` (
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
   buffer_hours smallint NOT NULL DEFAULT 0 , 
   booking_program_ind char(1) NOT NULL DEFAULT 'W' , 
   Max_reschedule smallint NOT NULL DEFAULT 0 , 

  
  PRIMARY KEY (`id`)
) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");

    AfwDatabase::db_query("create unique index uk_interview_type_pattern on ".$server_db_prefix."workflow.interview_type_pattern(lookup_code);");

    AfwDatabase::db_query("DROP TABLE IF EXISTS ".$server_db_prefix."workflow.slot_model;");

    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."workflow.`slot_model` (
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
  
    
   interview_type_pattern_id int(11) NOT NULL , 
   workflow_session_id int(11) NOT NULL , 
   workflow_scope_id int(11) NOT NULL DEFAULT 0 , 
   workflow_stage_id int(11) NOT NULL DEFAULT 0 , 
   interview_date datetime NOT NULL , 
   start_time varchar(8) NOT NULL DEFAULT '00:00' , 
   end_time varchar(8) NOT NULL DEFAULT '00:00' , 
   total_duration smallint NOT NULL DEFAULT 0 , 
   single_duration smallint NOT NULL DEFAULT 0 , 
   single_interviews_total smallint NOT NULL DEFAULT 0 , 
   capacity smallint NOT NULL DEFAULT 0 , 
   interview_type smallint NOT NULL DEFAULT 0 , 
   room_location varchar(255)   DEFAULT NULL , 
   workflow_commitee_id int(11) NOT NULL DEFAULT 0 , 
   buffer_minutes smallint NOT NULL DEFAULT 0 , 

  
  PRIMARY KEY (`id`)
) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");


    AfwDatabase::db_query("create unique index uk_slot_model on ".$server_db_prefix."workflow.slot_model(interview_type_pattern_id,workflow_session_id,interview_date);");

    AfwDatabase::db_query("DROP TABLE IF EXISTS ".$server_db_prefix."workflow.interview_slot_status;");

    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."workflow.`interview_slot_status` (
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
  
  
  PRIMARY KEY (`id`)
) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");


    AfwDatabase::db_query("create unique index uk_interview_slot_status on ".$server_db_prefix."workflow.interview_slot_status(lookup_code);");


    AfwDatabase::db_query("DROP TABLE IF EXISTS ".$server_db_prefix."workflow.interview_slot;");

    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."workflow.`interview_slot` (
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
  
    
   slot_model_id int(11) NOT NULL , 
   interview_date date DEFAULT NULL,
   start_time varchar(8) NOT NULL , 
   end_time varchar(8) NOT NULL DEFAULT '00:00' , 
   duration smallint NOT NULL DEFAULT 0 , 
   capacity smallint NOT NULL DEFAULT 0 , 
   booked_seats_count smallint NOT NULL DEFAULT 0 , 
   interview_type smallint NOT NULL DEFAULT 0 , 
   location varchar(200)  NOT NULL DEFAULT '' , 
   virtual_meeting_url varchar(200)  NOT NULL DEFAULT '' , 
   workflow_commitee_id int(11) NOT NULL DEFAULT 0 , 
   interview_slot_status_id int(11) NOT NULL DEFAULT 0 , 
  
  PRIMARY KEY (`id`)
) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");



    AfwDatabase::db_query("create unique index uk_interview_slot on ".$server_db_prefix."workflow.interview_slot(slot_model_id,interview_date,start_time);");



    AfwDatabase::db_query("DROP TABLE IF EXISTS ".$server_db_prefix."workflow.booking_status;");

    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."workflow.`booking_status` (
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

  
  PRIMARY KEY (`id`)
) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");

    AfwDatabase::db_query("create unique index uk_booking_status on ".$server_db_prefix."workflow.booking_status(lookup_code);");


    AfwDatabase::db_query("DROP TABLE IF EXISTS ".$server_db_prefix."workflow.interview_cancellation_reason;");

    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."workflow.`interview_cancellation_reason` (
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
  
  PRIMARY KEY (`id`)
) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");

    AfwDatabase::db_query("create unique index uk_interview_cancellation_reason on ".$server_db_prefix."workflow.interview_cancellation_reason(lookup_code);");



    AfwDatabase::db_query("DROP TABLE IF EXISTS ".$server_db_prefix."workflow.interview_booking;");

    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."workflow.`interview_booking` (
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
  
    
   interview_slot_id int(11) NOT NULL , 
   workflow_applicant_id bigint(20) NOT NULL , 
   workflow_session_id int(11) NOT NULL , 
   booking_status_id int(11) NOT NULL DEFAULT 0 , 
   booked_at datetime DEFAULT NULL , 
   booked_by int(11) DEFAULT NULL , 
   cancelled_at datetime DEFAULT NULL , 
   cancelled_by int(11) DEFAULT NULL , 
   interview_cancellation_reason_id int(11) DEFAULT NULL , 
   can_reschedule_ind char(1) DEFAULT NULL , 
   can_cancel_ind char(1) DEFAULT NULL , 
   no_show_flag char(1) DEFAULT NULL , 
   interviewer varchar(200)  DEFAULT NULL , 
  
  PRIMARY KEY (`id`)
) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");

    AfwDatabase::db_query("create unique index uk_interview_booking on ".$server_db_prefix."workflow.interview_booking(interview_slot_id,workflow_applicant_id,workflow_session_id);");


    AfwDatabase::db_query("DROP TABLE IF EXISTS ".$server_db_prefix."workflow.workflow_session;");

    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."workflow.`workflow_session` (
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
   external_code varchar(16)  NOT NULL , 
   session_code varchar(16)  NOT NULL DEFAULT '' , 
   workflow_session_name_ar varchar(200)   DEFAULT NULL , 
   workflow_session_name_en varchar(200)  DEFAULT NULL , 
   workflow_session_desc_ar text  DEFAULT NULL , 
   workflow_session_desc_en text  DEFAULT NULL , 
   
  
  PRIMARY KEY (`id`)
) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");

        AfwDatabase::db_query("create unique index uk_workflow_session on ".$server_db_prefix."workflow.workflow_session(workflow_model_id,external_code);");

}
catch(Exception $e)
{
    $migration_error .= " " . $e->getMessage();
}    