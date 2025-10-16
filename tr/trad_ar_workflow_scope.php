<?php
class WorkflowScopeArTranslator{

    public static function initData()
    {
        $trad = [];

	$trad["workflow_scope"]["workflowscope.single"] = "مجال";
	$trad["workflow_scope"]["workflowscope.new"] = "جديد ة";
	$trad["workflow_scope"]["workflow_scope"] = "المجالات";
	$trad["workflow_scope"]["scope_name_ar"] = "اسم المجال - عربي";
	$trad["workflow_scope"]["scope_name_en"] = "اسم المجال - انجليزي";
	$trad["workflow_scope"]["scope_description_ar"] = "وصف المجال - عربي";
	$trad["workflow_scope"]["scope_description_en"] = "وصف المجال - انجليزي";
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new WorkflowScopeEnTranslator();
		return new WorkflowScope();
	}
}