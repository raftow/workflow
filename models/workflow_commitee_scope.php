<?php
        class WorkflowCommiteeScope extends WorkflowObject{

                public static $DATABASE		= ""; 
                public static $MODULE		    = "workflow"; 
                public static $TABLE			= "workflow_commitee_scope"; 
                public static $DB_STRUCTURE = null;
                // public static $copypast = true;

                public function __construct(){
                        parent::__construct("workflow_commitee_scope","id","workflow");
                        WorkflowWorkflowCommiteeScopeAfwStructure::initInstance($this);
                        
                }

                public static function loadById($id)
                {
                        $obj = new WorkflowCommiteeScope();
                        
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

        }
?>