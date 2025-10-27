<?php
class NotificationArTranslator{

    public static function initData()
    {
        $trad = [];
	$trad["notification"]["step1"] = "التعريف";

	$trad["notification"]["notification.single"] = "إشعار";
	$trad["notification"]["notification.new"] = "جديد";
	$trad["notification"]["notification"] = "إشعارات";
	$trad["notification"]["workflow_module_id"] = "التطبيق";
	$trad["notification"]["workflow_entity_id"] = "الكيان";
	$trad["notification"]["destination_id"] = "الوجهة";
	$trad["notification"]["notification_template_id"] = "نموذج الاشعار";
	$trad["notification"]["email"] = "البريد الاكتروني";
	$trad["notification"]["mobile"] = "الجوال";
	$trad["notification"]["notification_title"] = "العنوان";
	$trad["notification"]["notification_body"] = "النص";
	$trad["notification"]["sent"] = "تم الإرسال";
	$trad["notification"]["sent_date"] = "تاريخ الإرسال";
	$trad["notification"]["received"] = "تم الاستلام";
	$trad["notification"]["received_date"] = "تاريخ الاستلام";
	$trad["notification"]["read"] = "تمت القراءة";
	$trad["notification"]["read_date"] = "تاريخ القراءة";
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new NotificationEnTranslator();
		return new Notification();
	}
}