<?php
        class WorkflowStage extends WorkflowObject{

                public static $DATABASE		= ""; 
                public static $MODULE		    = "workflow"; 
                public static $TABLE			= "workflow_stage"; 
                public static $DB_STRUCTURE = null;
                // public static $copypast = true;

                public function __construct(){
                        parent::__construct("workflow_stage","id","workflow");
                        WorkflowWorkflowStageAfwStructure::initInstance($this);
                        
                }

                public static function loadById($id)
                {
                        $obj = new WorkflowStage();
                        
                        if($obj->load($id))
                        {
                                return $obj;
                        }
                        else return null;
                }

                public function getDisplay($lang = 'ar')
                {
                        return $this->getDefaultDisplay($lang);
                }

                public function stepsAreOrdered()
                {
                        return false;
                }

                public function displayTreeviewDiv($lang, $parent_node_id, $workflowStatusList, $workflowActionList)
                {
                        $node_display = $this->getNodeDisplay($lang);
                        $node_id = "s".$this->id;

                        $html_children = "";

                        foreach($workflowStatusList as $workflowStatusObj)
                        {
                                $html_children .= $workflowStatusObj->displayTreeviewDiv($lang, $node_id, $workflowActionList[$workflowStatusObj->id])."\n";
                        }

                        return "<div id='node_$node_id' class='window hidden'
                        data-id='$node_id'
                        data-parent='$parent_node_id'
                        data-first-child='4'
                        data-next-sibling='2'>
                        $node_display
                        </div>
                        $html_children
                        ";

                }

        }
?>