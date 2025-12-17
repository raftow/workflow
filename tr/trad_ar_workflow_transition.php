<?php

class WorkflowTransitionArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["workflow_transition"]["workflowtransition.single"] = "تحول";
		$trad["workflow_transition"]["workflowtransition.new"] = "جديد(ة)";
		$trad["workflow_transition"]["workflow_transition"] = "التحولات";
		$trad["workflow_transition"]["name_ar"] = "مسمى  بالعربية";
		$trad["workflow_transition"]["name_en"] = "مسمى  بالانجليزية";
		$trad["workflow_transition"]["workflow_module_id"] = "التطبيق";
		$trad["workflow_transition"]["workflow_model_id"] = "نموذج سير عمل";
		$trad["workflow_transition"]["initial_stage_id"] = "المرحلة الإبتدائية";
		$trad["workflow_transition"]["initial_status_id"] = "حالة الطلب في البداية";
		$trad["workflow_transition"]["workflow_action_id"] = "الإجراء";
		$trad["workflow_transition"]["workflow_role_mfk"] = "الصلاحيات المطلوبة";
		$trad["workflow_transition"]["workflow_condition_id"] = "شرط تمكين الاجراء";
		$trad["workflow_transition"]["notification_template_id"] = "إشعار ما بعد التحول";
        $trad["workflow_transition"]["final_stage_id"] = "المرحلة النهائية";
		$trad["workflow_transition"]["final_status_id"] = "حالة الطلب في النهاية";
		
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new WorkflowTransitionEnTranslator();
		return new WorkflowTransition();
	}
}