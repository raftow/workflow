<?php

class ContentArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["content"]["content.single"] = "محتوى";
		$trad["content"]["content.new"] = "جديد(ة)";
		$trad["content"]["content"] = "محتويات";
		$trad["content"]["name_ar"] = "مسمى  بالعربية";
		$trad["content"]["desc_ar"] = "وصف  بالعربية";
		$trad["content"]["name_en"] = "مسمى  بالانجليزية";
		$trad["content"]["desc_en"] = "وصف  بالانجليزية";
		$trad["content"]["content_type_enum"] = "نوع المحتوى";
		$trad["content"]["lookup_code"] = "الرمز";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
		return new Content();
	}
}