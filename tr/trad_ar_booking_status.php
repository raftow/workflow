<?php

class BookingStatusArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["booking_status"]["bookingstatus.single"] = "Booking status";
		$trad["booking_status"]["bookingstatus.new"] = "جديد(ة)";
		$trad["booking_status"]["booking_status"] = "Booking statuss";
		$trad["booking_status"]["lookup_code"] = "الرمز الفني";
		$trad["booking_status"]["name_ar"] = "مسمى  بالعربية";
		$trad["booking_status"]["name_en"] = "مسمى  بالانجليزية";
		$trad["booking_status"]["desc_ar"] = "وصف  بالعربية";
		$trad["booking_status"]["desc_en"] = "وصف  بالانجليزية";
		$trad["booking_status"]["validated_by"] = "تم إعتماده من طرف";
		$trad["booking_status"]["validated_at"] = "تم إعتماده بتاريخ";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new BookingStatusEnTranslator();
		return new BookingStatus();
	}
}