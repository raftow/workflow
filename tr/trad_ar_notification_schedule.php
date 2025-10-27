<?php
class NotificationScheduleArTranslator{

    public static function initData()
    {
        $trad = [];

	$trad["notification_schedule"]["notificationschedule.single"] = "برمجة إشعار";
	$trad["notification_schedule"]["notificationschedule.new"] = "جديد";
	$trad["notification_schedule"]["notification_schedule"] = "برمجة إشعارات";
	$trad["notification_schedule"]["workflow_module_id"] = "التطبيق";
	$trad["notification_schedule"]["workflow_entity_id"] = "الكيان";
	$trad["notification_schedule"]["workflow_event_id"] = "الحدث";
	$trad["notification_schedule"]["notification_template_id"] = "نموذج الاشعار";
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new NotificationScheduleEnTranslator();
		return new NotificationSchedule();
	}
}