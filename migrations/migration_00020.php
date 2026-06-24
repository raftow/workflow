<?php
if (!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::currentDBPrefix();
try {
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
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.interview_type_pattern add   manual_booking_ind char(1) DEFAULT NULL  AFTER can_cancel_ind;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.interview_type_pattern add   add_interview_mandatory_ind char(1) DEFAULT NULL  AFTER manual_booking_ind;");
} catch (Exception $e) {
    $migration_error = " " . $e->getMessage();
}
