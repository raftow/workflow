<?php
class WorkflowStatusArTranslator{

    public static function initData()
    {
        $trad = [];
	$trad["workflow_status"]["step1"] = "التعريف";

	$trad["workflow_status"]["workflowstatus.single"] = "حالة طلب";
	$trad["workflow_status"]["workflowstatus.new"] = "جديدة";
	$trad["workflow_status"]["workflow_status"] = "حالات الطلبات";
	$trad["workflow_status"]["workflow_model_id"] = "نموذج سير العمل";
	$trad["workflow_status"]["workflow_status_name_ar"] = "اسم الحالة - عربي";
	$trad["workflow_status"]["workflow_status_name_en"] = "اسم الحالة - انجليزي";
	$trad["workflow_status"]["workflow_status_desc_ar"] = "وصف الحالة - عربي";
	$trad["workflow_status"]["workflow_status_desc_en"] = "وصف الحالة - انجليزي";
	$trad["workflow_status"]["status_code"] = "رمز الحالة";
	$trad["workflow_status"]["workflow_stage_id"] = "المرحلة المرتبطة";
	$trad["workflow_status"]["interview_invite_ind"] = "دعوة للمقابلة الشخصية؟";
	$trad["workflow_status"]["is_final"] = "حالة قبول نهائي؟";
	$trad["workflow_status"]["payment_ind"] = "حالة دفع؟";
	$trad["workflow_status"]["web_ind"] = "يظهر للمتقدم؟";
	$trad["workflow_status"]["applicant_can_cancel"] = "يمكن للمتقدم الإلغاء؟";
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new WorkflowStatusEnTranslator();
		return new WorkflowStatus();
	}
}