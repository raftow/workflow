<?php
class WorkflowActionArTranslator{

    public static function initData()
    {
        $trad = [];
	$trad["workflow_action"]["step1"] = "التعريف";

	$trad["workflow_action"]["workflowaction.single"] = "إجراء";
	$trad["workflow_action"]["workflowaction.new"] = "جديد";
	$trad["workflow_action"]["workflow_action"] = "إجراءات";
	$trad["workflow_action"]["workflow_model_id"] = "نموذج سير العمل";
	$trad["workflow_action"]["workflow_action_name_ar"] = "اسم الإجراء - عربي";
	$trad["workflow_action"]["workflow_action_name_en"] = "اسم الإجراء - انجليزي";
	$trad["workflow_action"]["action_type_enum"] = "نوع الإجراء";
	$trad["workflow_action"]["workflow_action_desc_ar"] = "وصف الإجراء - عربي";
	$trad["workflow_action"]["workflow_action_desc_en"] = "وصف الإجراء - انجليزي";
	$trad["workflow_action"]["comments_mandatory"] = "تعليق الزامي";
	$trad["workflow_action"]["workflow_stage_id"] = "المرحلة المرتبطة";
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new WorkflowActionEnTranslator();
		return new WorkflowAction();
	}
}