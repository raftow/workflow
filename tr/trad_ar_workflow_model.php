<?php
class WorkflowModelArTranslator
{

	public static function initData()
	{
		$trad = [];
		$trad["workflow_model"]["step1"] = "التعريف";
		$trad["workflow_model"]["step2"] = "التحولات";

		$trad["workflow_model"]["workflowTransitionList"] = "قائمة التحولات";

		$trad["workflow_model"]["workflowmodel.single"] = "نموذج سير عمل";
		$trad["workflow_model"]["workflowmodel.new"] = "جديد";
		$trad["workflow_model"]["workflow_model"] = "نماذج سير العمل";
		$trad["workflow_model"]["workflow_model_name_ar"] = "اسم النموذج - عربي";
		$trad["workflow_model"]["workflow_model_name_en"] = "اسم النموذج - انجليزي";
		$trad["workflow_model"]["workflow_model_desc_ar"] = "وصف النموذج - عربي";
		$trad["workflow_model"]["workflow_model_desc_en"] = "وصف النموذج - انجليزي";
		$trad["workflow_model"]["workflow_field_mfk"] = "البيانات المطلوبة";
		return $trad;
	}

	public static function getInstance()
	{
		if (false) return new WorkflowModelEnTranslator();
		return new WorkflowModel();
	}
}
