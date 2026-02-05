<?php

class NotificationPlaceholderEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["notification_placeholder"]["notificationplaceholder.single"] = "Notification Placeholders";
		$trad["notification_placeholder"]["notificationplaceholder.new"] = "new";
		$trad["notification_placeholder"]["notification_placeholder"] = "Notification Placeholder";
		$trad["notification_placeholder"]["name_ar"] = "Arabic Notification placeholder name";
		$trad["notification_placeholder"]["name_en"] = "English Notification placeholder name";
		$trad["notification_placeholder"]["desc_ar"] = "Arabic Notification placeholder description";
		$trad["notification_placeholder"]["desc_en"] = "English Notification placeholder description";
		$trad["notification_placeholder"]["placeholder_code"] = "Placeholder Code";
		$trad["notification_placeholder"]["placeholder_label"] = "Placeholder Label";
		$trad["notification_placeholder"]["placeholder_table"] = "Table Name";
		$trad["notification_placeholder"]["placeholber_columnm"] = "Column Name";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new NotificationPlaceholderArTranslator();
		return new NotificationPlaceholder();
	}
}