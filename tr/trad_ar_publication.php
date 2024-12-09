<?php

class PublicationArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["publication"]["publication.single"] = "منشور";
		$trad["publication"]["publication.new"] = "جديد(ة)";
		$trad["publication"]["publication"] = "المنشورات";
		$trad["publication"]["name_ar"] = "مسمى  بالعربية";
		$trad["publication"]["desc_ar"] = "وصف  بالعربية";
		$trad["publication"]["name_en"] = "مسمى  بالانجليزية";
		$trad["publication"]["desc_en"] = "وصف  بالانجليزية";
		$trad["publication"]["title_ar"] = "عنوان النموذج";
		$trad["publication"]["title_en"] = "مسمى المنشور بالانجليزي";
		$trad["publication"]["summary_ar"] = "الملخص بالعربية";
		$trad["publication"]["summary_en"] = "الملخص بالانجليزية";
		$trad["publication"]["published"] = "منشور";
		$trad["publication"]["publish_start_date"] = "تاريخ بداية النشر بالهجري";
		$trad["publication"]["publish_end_date"] = "تاريخ نهاية النشر  بالهجري";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
		return new Publication();
	}
}