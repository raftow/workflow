<?php
if (!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::currentDBPrefix();
try {

    // AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_request add   idn varchar(32)  NOT NULL DEFAULT ''  AFTER workflow_applicant_id;");
    // update nauss_workflow.workflow_request set idn = workflow_applicant_id;
    //AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.workflow_transition add   application_model_financial_transaction_id int(11) DEFAULT NULL  AFTER next_transition_id;");
    AfwDatabase::db_query("DROP TABLE IF EXISTS " . $server_db_prefix . "workflow.`notification_template`;");
    AfwDatabase::db_query("CREATE TABLE " . $server_db_prefix . "workflow.`notification_template` (
  `id` int NOT NULL AUTO_INCREMENT,
  `notification_code` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `created_by` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int NOT NULL,
  `updated_at` datetime NOT NULL,
  `validated_by` int DEFAULT NULL,
  `validated_at` datetime DEFAULT NULL,
  `active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `draft` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `version` int DEFAULT NULL,
  `update_groups_mfk` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `delete_groups_mfk` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `display_groups_mfk` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `sci_id` int DEFAULT NULL,
  `workflow_module_id` int NOT NULL,
  `workflow_entity_id` int NOT NULL,
  `recipient_type_enum` smallint NOT NULL DEFAULT '0',
  `channel_enum` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `notification_title` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `notification_title_en` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '',
  `notification_body` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `notification_body_en` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `notification_email` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `notification_email_en` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `language_enum` smallint DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_notification_template` (`workflow_module_id`,`workflow_entity_id`,`notification_title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;");
    
AfwDatabase::db_query("DROP TABLE IF EXISTS " . $server_db_prefix . "workflow.notification_placeholder;");

    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS " . $server_db_prefix . "workflow.notification_placeholder (
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
        
            
        placeholder_code varchar(16)  NOT NULL , 
        placeholder_label varchar(32)  NOT NULL DEFAULT '' , 
        placeholder_table varchar(32)  NOT NULL DEFAULT '' , 
        placeholber_columnm varchar(32)  NOT NULL DEFAULT '' , 
       

        
        PRIMARY KEY (`id`)
        ) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");


    AfwDatabase::db_query("create unique index uk_notification_placeholder on " . $server_db_prefix . "workflow.notification_placeholder(placeholder_code);");

    AfwDatabase::db_query("DROP TABLE IF EXISTS " . $server_db_prefix . "workflow.`notification`;");
    AfwDatabase::db_query("CREATE TABLE " . $server_db_prefix . "workflow.`notification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `workflow_applicant_id` int NOT NULL DEFAULT '0',
  `created_by` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int NOT NULL,
  `updated_at` datetime NOT NULL,
  `validated_by` int DEFAULT NULL,
  `validated_at` datetime DEFAULT NULL,
  `active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `draft` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `version` int DEFAULT NULL,
  `update_groups_mfk` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `delete_groups_mfk` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `display_groups_mfk` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `sci_id` int DEFAULT NULL,
  `workflow_module_id` int NOT NULL,
  `workflow_entity_id` int NOT NULL,
  `destination_id` bigint DEFAULT NULL,
  `notification_template_id` int DEFAULT NULL,
  `workflow_event_id` int DEFAULT NULL,
  `event_date` datetime DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mobile` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `notification_title` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `notification_body` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `sent` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `sent_date` datetime DEFAULT NULL,
  `received` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `received_date` datetime DEFAULT NULL,
  `read` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `read_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_notification` (`workflow_module_id`,`workflow_entity_id`,`destination_id`,`notification_template_id`,`workflow_event_id`,`event_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;");
    
} catch (Exception $e) {
    $migration_error = " " . $e->getMessage();
}
