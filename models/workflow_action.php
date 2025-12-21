<?php
        class WorkflowAction extends WorkflowObject{

                public static $DATABASE		= ""; 
                public static $MODULE		    = "workflow"; 
                public static $TABLE			= "workflow_action"; 
                public static $DB_STRUCTURE = null;
                // public static $copypast = true;

                public function __construct(){
                        parent::__construct("workflow_action","id","workflow");
                        WorkflowWorkflowActionAfwStructure::initInstance($this);
                        
                }

                public static function loadById($id)
                {
                        $obj = new WorkflowAction();
                        
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


                public function displayTreeviewDiv($lang, $parent_node_id)
                {                        
                        $node_display = $this->getNodeDisplay($lang);
                        $node_id = $parent_node_id."a".$this->id;

                        $html_children = "";
                        
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