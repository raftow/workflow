<?php

class NotificationTemplateArTranslator{

    public static function initData()
    {
        $trad = [];

        $trad["notification_template"]["notificationtemplate.single"] = "نموذج إشعار";
        $trad["notification_template"]["notificationtemplate.new"] = "جديد";
        $trad["notification_template"]["notification_template"] = "نماذج إشعار";
        $trad["notification_template"]["workflow_module_id"] = "التطبيق";
        $trad["notification_template"]["workflow_entity_id"] = "الكيان";
        $trad["notification_template"]["notification_title"] = "العنوان";
        $trad["notification_template"]["notification_title_en"] = "العنوان - انجليزي";
        $trad["notification_template"]["notification_body"] = "النص";
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new NotificationTemplateEnTranslator();
		return new NotificationTemplate();
	}
}