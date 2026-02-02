<?php
class WorkflowStageArTranslator
{

	public static function initData()
	{
		$trad = [];
		$trad["workflow_stage"]["step1"] = "التعريف";

		$trad["workflow_stage"]["workflowstage.single"] = "مرحلة";
		$trad["workflow_stage"]["workflowstage.new"] = "جديدة";
		$trad["workflow_stage"]["workflow_stage"] = "المراحل";
		$trad["workflow_stage"]["workflow_model_id"] = "نموذج سير العمل";
		$trad["workflow_stage"]["workflow_stage_name_ar"] = "اسم المرحلة - عربي";
		$trad["workflow_stage"]["workflow_stage_name_en"] = "اسم المرحلة - انجليزي";
		$trad["workflow_stage"]["workflow_stage_desc_ar"] = "وصف المرحلة - عربي";
		$trad["workflow_stage"]["workflow_stage_desc_en"] = "وصف المرحلة - انجليزي";
		$trad["workflow_stage"]["step_code"] = "رمز المرحلة";
		$trad["workflow_stage"]["required_application_field_mfk"] = "البيانات المطلوبة لهذه المرحلة";
		$trad["workflow_stage"]["standard_processing_time"] = "الوقت المعياري للمعالجة";
		$trad["workflow_stage"]["time_unit"] = "وحدة زمنية";
		$trad["workflow_stage"]["processing_request_responsibility"] = "مسؤولية معالجة الطلب";
		$trad["workflow_stage"]["workflow_role_id"] = "الدور المعني";
		$trad["workflow_stage"]["interview_ind"] = "يتضمن مقابلة شخصية";
		$trad["workflow_stage"]["orgunit_id"] = "الإدارة/اللجنة المعنية";
		$trad["workflow_stage"]["orgunit_id.short"] = "الإدارة/اللجنة";
		$trad["workflow_stage"]["color_enum"] = "اللون";
		


		return $trad;
	}

	public static function getInstance()
	{
		if (false) return new WorkflowStageEnTranslator();
		return new WorkflowStage();
	}
}
