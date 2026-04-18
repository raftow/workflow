<?php
class WorkflowFinancialTransactionArTranslator
{

	public static function initData()
	{
		$trad = [];

		$trad["workflow_financial_transaction"]["workflowfinancialtransaction.single"] = "حركة مالية";
		$trad["workflow_financial_transaction"]["workflowfinancialtransaction.new"] = "جديدة";
		$trad["workflow_financial_transaction"]["workflow_financial_transaction"] = "الحركات المالية";
		$trad["workflow_financial_transaction"]["scope_name_ar"] = "اسم الحركة - عربي";
		$trad["workflow_financial_transaction"]["scope_name_en"] = "اسم الحركة - انجليزي";
		$trad["workflow_financial_transaction"]["scope_description_ar"] = "وصف الحركة - عربي";
		$trad["workflow_financial_transaction"]["scope_description_en"] = "وصف الحركة - انجليزي";
		$trad["workflow_financial_transaction"]["workflow_module_id"] = "التطبيق";
		$trad["workflow_financial_transaction"]["workflow_model_id"] = "نموذج سير العمل";
		return $trad;
	}

	public static function getInstance()
	{
		//if (false) return new WorkflowFinancialTransactionEnTranslator();
		return new WorkflowFinancialTransaction();
	}
}
