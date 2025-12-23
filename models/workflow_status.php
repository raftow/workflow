<?php
        class WorkflowStatus extends WorkflowObject{

                public static $DATABASE		= ""; 
                public static $MODULE		    = "workflow"; 
                public static $TABLE			= "workflow_status"; 
                public static $DB_STRUCTURE = null;
                // public static $copypast = true;

                public function __construct(){
                        parent::__construct("workflow_status","id","workflow");
                        WorkflowWorkflowStatusAfwStructure::initInstance($this);
                        
                }

                public static function loadById($id)
                {
                        $obj = new WorkflowStatus();
                        
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


                public function displayTreeviewDiv($lang, $parent_node_id, $workflowActionList)
                {                        
                        $node_display = $this->getNodeDisplay($lang);
                        $node_id = $parent_node_id."t".$this->id;

                        $html_children = "";
                        $my_first_child_node_id = null;
                        $previous_node = null;
                        foreach($workflowActionList as $workflowActionObj)
                        {
                                /**
                                 * @var WorkflowAction $workflowActionObj
                                 */
                                list($my_node_id, $node_html) = $workflowActionObj->displayTreeviewDiv($lang, $node_id);
                                if($previous_node)
                                {
                                        $html_children = str_replace("[next-of-$previous_node]", $my_node_id, $html_children);       
                                }
                                if(!$my_first_child_node_id) $my_first_child_node_id = $my_node_id;
                                $html_children .= $node_html;
                                $previous_node = $my_node_id;
                        }

                        if($previous_node)
                        {
                                $html_children = str_replace("[next-of-$previous_node]", "", $html_children);       
                        }

                        // if($node_id=="s1t1") die("html_children = $html_children");

                        return [$node_id, 
                        "<div id='node_$node_id' class='window hiddon status'
                                data-id='$node_id'
                                data-parent=\"$parent_node_id\"
                                data-first-child=\"$my_first_child_node_id\"
                                data-next-sibling='[next-of-$node_id]'>
                        $node_display <br>
                                <span class='count app status'>7</span>
                        </div>
                        $html_children
                        "];

                }

        }
?>