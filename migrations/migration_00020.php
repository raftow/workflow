<?php
if (!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::currentDBPrefix();
try {
    AfwDatabase::db_query("DROP TABLE IF EXISTS " . $server_db_prefix . "workflow.`workflow_employee`;");
    AfwDatabase::db_query("CREATE TABLE " . $server_db_prefix . "workflow.`workflow_employee` (
  `id` int NOT NULL AUTO_INCREMENT,
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
  `orgunit_id` int NOT NULL,
  `email` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `employee_id` int NOT NULL,
  `firstname` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `f_firstname` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `g_f_firstname` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `lastname` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `lastname_en` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `g_f_firstname_en` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `f_firstname_en` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `firstname_en` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `gender_id` smallint NOT NULL DEFAULT '1',
  `country_id` int DEFAULT NULL,
  `mobile` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `wrole_mfk` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `wscope_mfk` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `approved` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `hierarchy_level_enum` smallint NOT NULL DEFAULT '999',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_workflow_employee` (`orgunit_id`,`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;");
    AfwDatabase::db_query("UPDATE " . $server_db_prefix . "workflow.workflow_employee me SET updated_by = 1, updated_at = '2026-06-24 17:59:21', version = version + 1,  hierarchy_level_enum = '1500'
        WHERE wrole_mfk=',4,';");

    AfwDatabase::db_query("UPDATE " . $server_db_prefix . "ums.auser 
                     SET hierarchy_level_enum = '1500' 
                     WHERE id in (select auser_id 
                                  from " . $server_db_prefix . "hrm.employee 
                                   where id in (select employee_id 
                                                from " . $server_db_prefix . "workflow.workflow_employee 
                                                   where hierarchy_level_enum = '1500'
                                                )
                                );");


AfwDatabase::db_query("DROP TABLE IF EXISTS " . $server_db_prefix . "workflow.`interview_type_pattern`;");
AfwDatabase::db_query("CREATE TABLE " . $server_db_prefix . "workflow.`interview_type_pattern` (
  `id` int NOT NULL AUTO_INCREMENT,
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
  `lookup_code` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `name_ar` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `name_en` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `desc_ar` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `desc_en` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `workflow_stage_id` int NOT NULL DEFAULT '0',
  `buffer_hours` smallint NOT NULL DEFAULT '0',
  `booking_program_ind` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'W',
  `Max_reschedule` smallint NOT NULL DEFAULT '0',
  `can_cancel_ind` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `manual_booking_ind` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `add_interview_mandatory_ind` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pk2_interview_type_pattern` (`workflow_stage_id`),
  UNIQUE KEY `uk_interview_type_pattern` (`lookup_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;");
    // AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.interview_type_pattern add   manual_booking_ind char(1) DEFAULT NULL  AFTER can_cancel_ind;");
    // AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.interview_type_pattern add   add_interview_mandatory_ind char(1) DEFAULT NULL  AFTER manual_booking_ind;");
} catch (Exception $e) {
    $migration_error = " " . $e->getMessage();
}
