<?php

class ContentItemEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["content_item"]["contentitem.single"] = "  ";
		$trad["content_item"]["contentitem.new"] = "new";
		$trad["content_item"]["content_item"] = "  ";
		$trad["content_item"]["name_ar"] = "Arabic Content item name";
		$trad["content_item"]["desc_ar"] = "Arabic Content item description";
		$trad["content_item"]["name_en"] = "English Content item name";
		$trad["content_item"]["desc_en"] = "English Content item description";
		$trad["content_item"]["content_id"] = "Content";
		$trad["content_item"]["content_type_enum"] = "Content type enum";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
		return new ContentItem();
	}
}