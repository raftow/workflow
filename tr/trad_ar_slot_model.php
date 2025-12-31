<?php

class SlotModelArTranslator{
    public static function initData()
    {
        $trad = [];
		$trad["slot_model"]["step1"] = "نموذج المقابلة";
		$trad["slot_model"]["step2"] = "المواعيد الفردية";

		$trad["slot_model"]["slotmodel.single"] = "نموذج موعد المقابلة";
		$trad["slot_model"]["slotmodel.new"] = "جديد(ة)";
		$trad["slot_model"]["slot_model"] = "نموذج مواعيد المقابلة";
		$trad["slot_model"]["name_ar"] = "مسمى  بالعربية";
		$trad["slot_model"]["name_en"] = "مسمى  بالانجليزية";
		$trad["slot_model"]["desc_ar"] = "وصف  بالعربية";
		$trad["slot_model"]["desc_en"] = "وصف  بالانجليزية";
		$trad["slot_model"]["interview_type_pattern_id"] = "نموذج المقابلة";
		$trad["slot_model"]["workflow_session_id"] = "دورة القبول";
		$trad["slot_model"]["workflow_scope_id"] = "البرنامج";
		$trad["slot_model"]["workflow_stage_id"] = "المرحلة";
		$trad["slot_model"]["interview_date"] = "اليوم";
		$trad["slot_model"]["start_time"] = "وقت البداية";
		$trad["slot_model"]["end_time"] = "وقت النهاية";
		$trad["slot_model"]["total_duration"] = "مدة المقابلة (دقائق)";
		$trad["slot_model"]["single_duration"] = "مدة المقابلة الفردية(دقائق";
		$trad["slot_model"]["single_interviews_total"] = "عدد المواعيد الفردية";
		$trad["slot_model"]["capacity"] = "الطاقة الاستيعابية الفردية";
		$trad["slot_model"]["interview_type"] = "نوع المقابلة";
		$trad["slot_model"]["room_location"] = "الموقع";
		$trad["slot_model"]["workflow_commitee_id_"] = "اللجنة/المحاورون";
		$trad["slot_model"]["buffer_minutes"] = "المدة الفاصلة: مدة بالدقائق";
		$trad["slot_model"]["workflow_commitee_id"] = "اللجنة/المحاورون";
		$trad["slot_model"]["InterviewSlotList"] = "قائمة مواعيد المقابلة";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new SlotModelEnTranslator();
		return new SlotModel();
	}
}