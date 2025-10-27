<?php
class NotificationTemplateEnTranslator{

    public static function initData()
    {
        $trad = [];

	$trad["notification_template"]["notificationtemplate.single"] = "Notification template";
	$trad["notification_template"]["notificationtemplate.new"] = "new";
	$trad["notification_template"]["notification_template"] = "Notification templates";
	$trad["notification_template"]["workflow_module_id"] = "Module";
	$trad["notification_template"]["workflow_entity_id"] = "Entity";
	$trad["notification_template"]["notification_title"] = "Title";
	$trad["notification_template"]["notification_body"] = "Body";
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new NotificationTemplateArTranslator();
		return new NotificationTemplate();
	}
}