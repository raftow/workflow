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
                        $my_first_child_status_id = null;
                        $previous_node = null;
                        foreach($workflowStatusList as $workflowStatusObj)
                        {
                                $myWorkflowActionList = $workflowActionList[$workflowStatusObj->id];                                
                                if((($this->id==1) and ($workflowStatusObj->id==22)) or (!$myWorkflowActionList) or (!is_array($myWorkflowActionList)) or (count($myWorkflowActionList)==0))
                                {
                                        die("workflowStatusList = ".var_export($workflowStatusList, true)." myWorkflowActionList[$workflowStatusObj->id] = ".var_export($myWorkflowActionList, true));
                                }
                                /**
                                 * @var WorkflowStatus $workflowStatusObj
                                 */
                                $arrResult = $workflowStatusObj->displayTreeviewDiv($lang, $node_id, $myWorkflowActionList);
                                list($my_node_id, $node_html) = $arrResult;
                                // if(!$node_html) die("workflowStatusObj($workflowStatusObj->id)->displayTreeviewDiv($lang, $node_id, myWorkflowActionList)")
                                if($previous_node)
                                {
                                        $html_children = str_replace("[next-of-$previous_node]", $my_node_id, $html_children);       
                                }
                                if(!$my_first_child_status_id) $my_first_child_status_id = $my_node_id;
                                $html_children .= $node_html;
                                $previous_node = $my_node_id;
                        }

                        if($previous_node)
                        {
                                $html_children = str_replace("[next-of-$previous_node]", "", $html_children);       
                        }

                        // die("html_children of stage $node_id = ".$html_children."  workflowStatusList = ".var_export($workflowStatusList, true)."");

                        return [$node_id, 
                        "<div id='node_$node_id' class='window hiddon stage'
                                data-id='$node_id'
                                data-parent=\"$parent_node_id\"
                                data-first-child=\"$my_first_child_status_id\"
                                data-next-sibling=\"[next-of-$node_id]\">
                        $node_display
                        <br><span class='count app stage'>10</span>
                        </div>
                        $html_children
                        "];

                }

        }
?>