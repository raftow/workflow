<?php

class BookingStatusEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["booking_status"]["bookingstatus.single"] = "Booking status";
		$trad["booking_status"]["bookingstatus.new"] = "new";
		$trad["booking_status"]["booking_status"] = "Booking statuss";
		$trad["booking_status"]["name_ar"] = "Arabic Interview slot name";
		$trad["booking_status"]["name_en"] = "English Interview slot name";
		$trad["booking_status"]["desc_ar"] = "Arabic Interview slot description";
		$trad["booking_status"]["desc_en"] = "English Interview slot description";
		$trad["booking_status"]["validated_by"] = "Validated by";
		$trad["booking_status"]["validated_at"] = "Validated at";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new BookingStatusArTranslator();
		return new BookingStatus();
	}
}