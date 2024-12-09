<?php

class PageEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["page"]["page.single"] = "????";
		$trad["page"]["page.new"] = "new";
		$trad["page"]["page"] = "???????";
		$trad["page"]["module_id"] = "model";
		$trad["page"]["name_ar"] = "Arabic Page name";
		$trad["page"]["desc_ar"] = "Arabic Page description";
		$trad["page"]["name_en"] = "English Page name";
		$trad["page"]["desc_en"] = "English Page description";
		$trad["page"]["pageItemList"] = "List of ????? ???????";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
		return new Page();
	}
}