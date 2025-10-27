<?php
class NotificationEnTranslator{

    public static function initData()
    {
        $trad = [];
	$trad["notification"]["step1"] = "Definition";

	$trad["notification"]["notification.single"] = "Notification";
	$trad["notification"]["notification.new"] = "new";
	$trad["notification"]["notification"] = "Notifications";
	$trad["notification"]["workflow_module_id"] = "Module";
	$trad["notification"]["workflow_entity_id"] = "Entity";
	$trad["notification"]["destination_id"] = "Destination";
	$trad["notification"]["notification_template_id"] = "Notification template";
	$trad["notification"]["email"] = "email";
	$trad["notification"]["mobile"] = "mobile";
	$trad["notification"]["notification_title"] = "notification title";
	$trad["notification"]["notification_body"] = "notification body";
	$trad["notification"]["sent"] = "sent";
	$trad["notification"]["sent_date"] = "sent date";
	$trad["notification"]["received"] = "received";
	$trad["notification"]["received_date"] = "received date";
	$trad["notification"]["read"] = "read";
	$trad["notification"]["read_date"] = "read date";
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new NotificationArTranslator();
		return new Notification();
	}
}