<?php
if (!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::currentDBPrefix();
try {



AfwDatabase::db_query("DROP TABLE IF EXISTS " . $server_db_prefix . "workflow.workflow_status");
AfwDatabase::db_query("CREATE TABLE " . $server_db_prefix . "workflow.workflow_status (
  `id` int NOT NULL AUTO_INCREMENT,
  `workflow_model_id` int NOT NULL,
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
  `lookup_code` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `workflow_status_name_ar` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `workflow_status_name_en` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `workflow_status_desc_ar` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `workflow_status_desc_en` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `status_code` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `workflow_stage_id` int DEFAULT NULL,
  `interview_invite_ind` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `is_final` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `payment_ind` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `web_ind` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `applicant_can_cancel` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `last_payment_deadline` smallint DEFAULT NULL,
  `sis_status_code` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_workflow_status` (`workflow_model_id`,`status_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;");

} catch (Exception $e) {
    $migration_error = " " . $e->getMessage();
}
