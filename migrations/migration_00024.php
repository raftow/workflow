<?php
if (!class_exists("AfwSession")) die("Denied access");
/**
 * @var string $migration_error
 */
$server_db_prefix = AfwSession::currentDBPrefix();
try {
    AfwDatabase::db_query("ALTER TABLE  " . $server_db_prefix . "workflow.`notification` CHANGE `destination_id` `destination_id` varchar(64) NULL AFTER `workflow_entity_id`;");


    /*INSERT INTO tvtc_workflow.workflow_module 
    SET id = 1,
        lookup_code = 'HRM', 
        module_name_ar = _utf8'إدارة الموارد البشرية', 
        module_name_en = 'Human Ressource Management', 
        module_description_ar = _utf8'', 
        module_description_en = '', 
        created_by = 1, updated_by = 1, validated_by = 0, active = 'Y', draft = 'Y', 
        update_groups_mfk = ',', delete_groups_mfk = ',', display_groups_mfk = ',', 
        sci_id = 1, created_at = '2026-09-07 10:58:26', updated_at = '2026-09-07 10:58:26', version = 1;
        
 INSERT INTO tvtc_workflow.workflow_module 
    SET id = 2,
        lookup_code = 'CRM', 
        module_name_ar = _utf8'خدمة العملاء', 
        module_name_en = 'Customer relationship management', 
        module_description_ar = _utf8'', 
        module_description_en = '', 
        created_by = 1, updated_by = 1, validated_by = 0, active = 'Y', draft = 'Y', 
        update_groups_mfk = ',', delete_groups_mfk = ',', display_groups_mfk = ',', 
        sci_id = 1, created_at = '2026-09-07 10:58:26', updated_at = '2026-09-07 10:58:26', version = 1;*/

} catch (Exception $e) {
    $migration_error = " " . $e->getMessage();
}
