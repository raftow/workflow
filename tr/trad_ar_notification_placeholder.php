<?php

class NotificationPlaceholderArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["notification_placeholder"]["notificationplaceholder.single"] = "حقول الرسائل الديناميكية";
		$trad["notification_placeholder"]["notificationplaceholder.new"] = "جديد(ة)";
		$trad["notification_placeholder"]["notification_placeholder"] = "حقول الرسائل الديناميكية";
		$trad["notification_placeholder"]["name_ar"] = "مسمى  بالعربية";
		$trad["notification_placeholder"]["name_en"] = "مسمى  بالانجليزية";
		$trad["notification_placeholder"]["desc_ar"] = "وصف  بالعربية";
		$trad["notification_placeholder"]["desc_en"] = "وصف  بالانجليزية";
		$trad["notification_placeholder"]["placeholder_code"] = "كود العنصر";
		$trad["notification_placeholder"]["placeholder_label"] = "اسم العنصر";
		$trad["notification_placeholder"]["placeholder_table"] = "اسم الجدول";
		$trad["notification_placeholder"]["placeholber_columnm"] = "اسم الحقل";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new NotificationPlaceholderEnTranslator();
		return new NotificationPlaceholder();
	}
}