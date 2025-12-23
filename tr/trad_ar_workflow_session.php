<?php

class WorkflowSessionArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["workflow_session"]["workflowsession.single"] = "دورة إجراءات قبول";
		$trad["workflow_session"]["workflowsession.new"] = "جديد(ة)";
		$trad["workflow_session"]["workflow_session"] = "دورات إجراءات القبول";
		$trad["workflow_session"]["name_ar"] = "مسمى  بالعربية";
		$trad["workflow_session"]["name_en"] = "مسمى  بالانجليزية";
		$trad["workflow_session"]["desc_ar"] = "وصف  بالعربية";
		$trad["workflow_session"]["desc_en"] = "وصف  بالانجليزية";
		$trad["workflow_session"]["workflow_model_id"] = "نموذج سير العمل";
		$trad["workflow_session"]["external_code"] = "الرمز الخارجي للدورة";
		$trad["workflow_session"]["session_code"] = "الرمز الداخلي للدورة";
		$trad["workflow_session"]["workflow_session_name_ar"] = "اسم الدورة عربي";
		$trad["workflow_session"]["workflow_session_name_en"] = "اسم الدورة انجليزي";
		$trad["workflow_session"]["workflow_session_desc_ar"] = "وصف الدورة عربي";
		$trad["workflow_session"]["workflow_session_desc_en"] = "وصف الدورة انجليزي";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new WorkflowSessionEnTranslator();
		return new WorkflowSession();
	}
}