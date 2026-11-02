<?php

class WorkflowSourceEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["workflow_source"]["workflowsource.single"] = "Workflow source";
		$trad["workflow_source"]["workflowsource.new"] = "new";
		$trad["workflow_source"]["workflow_source"] = "Workflow sources";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new WorkflowSourceArTranslator();
		return new WorkflowSource();
	}
}