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
                        $my_first_child_node_id = null;
                        $previous_node = null;
                        foreach($workflowStatusList as $workflowStatusObj)
                        {                                
                                list($my_node_id, $node_html) = $workflowStatusObj->displayTreeviewDiv($lang, $node_id, $workflowActionList[$workflowStatusObj->id])."\n";
                                if($previous_node)
                                {
                                        $html_children = str_replace("[next-of-$previous_node]", $my_node_id, $html_children);       
                                }
                                if(empty($my_first_child_node_id)) $my_first_child_node_id = $my_node_id;
                                $html_children .= $node_html;
                                $previous_node = $my_node_id;
                        }

                        return [$node_id, "<div id='node_$node_id' class='window hidden'
                        data-id='$node_id'
                        data-parent='$parent_node_id'
                        data-first-child='$my_first_child_node_id'
                        data-next-sibling='[next-of-$node_id]'>
                        $node_display
                        </div>
                        $html_children
                        "];

                }

        }
?>