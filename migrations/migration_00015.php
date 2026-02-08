<?php
if (!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::currentDBPrefix();
try {

    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.notification_template add   notification_code varchar(32)  NOT NULL DEFAULT ''  AFTER id;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.notification_template add   recipient_type_enum smallint NOT NULL DEFAULT 0  AFTER workflow_entity_id;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.notification_template add   channel_enum text  DEFAULT NULL  AFTER recipient_type_enum;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.notification_template add   notification_body_en text  DEFAULT NULL  AFTER notification_body;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.notification_template add   language_enum smallint DEFAULT NULL  AFTER notification_body_en;");
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

    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.notification add   workflow_applicant_id int(11) NOT NULL DEFAULT 0  AFTER id;");
AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.notification_template add   notification_email text  DEFAULT NULL  AFTER notification_body_en;");
AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "workflow.notification_template add   notification_email_en text  DEFAULT NULL  AFTER notification_email;");
} catch (Exception $e) {
    $migration_error .= " " . $e->getMessage();
}
