<?php
class NotificationScheduleEnTranslator{

    public static function initData()
    {
        $trad = [];

	$trad["notification_schedule"]["notificationschedule.single"] = "Notification schedule";
	$trad["notification_schedule"]["notificationschedule.new"] = "new";
	$trad["notification_schedule"]["notification_schedule"] = "Notification schedules";
	$trad["notification_schedule"]["workflow_module_id"] = "Module";
	$trad["notification_schedule"]["workflow_entity_id"] = "Entity";
	$trad["notification_schedule"]["workflow_event_id"] = "Event";
	$trad["notification_schedule"]["notification_template_id"] = "Notification template";
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new NotificationScheduleArTranslator();
		return new NotificationSchedule();
	}
}