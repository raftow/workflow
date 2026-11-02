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
        $trad["notification_template"]["notification_body_en"] = "النص - انجليزي";
        $trad["notification_template"]["notification_code"] = "كود الإشعار";
        $trad["notification_template"]["recipient_type_enum"] = "نوع المستلم";
        $trad["notification_template"]["channel_enum"] = "قناة الإرسال";
        $trad["notification_template"]["language_enum"] = "اللغة";
        $trad["notification_template"]["notification_email"] = "النص للبريد الإلكتروني";
        $trad["notification_template"]["notification_email_en"] = "النص للبريد الإلكتروني - انجليزي";
        
        
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new NotificationTemplateEnTranslator();
		return new NotificationTemplate();
	}
}