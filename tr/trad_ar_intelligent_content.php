<?php

class IntelligentContentArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["intelligent_content"]["intelligentcontent.single"] = " الذكية";
		$trad["intelligent_content"]["intelligentcontent.new"] = "جديد(ة)";
		$trad["intelligent_content"]["intelligent_content"] = "المحتويات";
		$trad["intelligent_content"]["name_ar"] = "مسمى  بالعربية";
		$trad["intelligent_content"]["desc_ar"] = "وصف  بالعربية";
		$trad["intelligent_content"]["name_en"] = "مسمى  بالانجليزية";
		$trad["intelligent_content"]["desc_en"] = "وصف  بالانجليزية";
		$trad["intelligent_content"]["module_id"] = "التطبيق";
		$trad["intelligent_content"]["lookup_code"] = "الرمز";
		$trad["intelligent_content"]["content_type_enum"] = "نوع المحتوى";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
		return new IntelligentContent();
	}
}