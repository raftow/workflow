<?php
class WorkflowModelEnTranslator{

    public static function initData()
    {
        $trad = [];
	$trad["workflow_model"]["step1"] = "Definition";

	$trad["workflow_model"]["workflowmodel.single"] = "Workflow model";
	$trad["workflow_model"]["workflowmodel.new"] = "new";
	$trad["workflow_model"]["workflow_model"] = "Workflow models";
	$trad["workflow_model"]["workflow_model_name_ar"] = "Model name - arabic";
	$trad["workflow_model"]["workflow_model_name_en"] = "Model name - english";
	$trad["workflow_model"]["workflow_model_desc_ar"] = "Model description - arabic";
	$trad["workflow_model"]["workflow_model_desc_en"] = "Model description - english";
	$trad["workflow_model"]["workflow_field_mfk"] = "Application field";
        return $trad;
        }

        public static function getInstance()
	{
                if(false) return new WorkflowModelArTranslator();
		return new WorkflowModel();
	}
}