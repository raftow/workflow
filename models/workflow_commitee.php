<?php
        class WorkflowCommitee extends WorkflowObject{

                public static $DATABASE		= ""; 
                public static $MODULE		    = "workflow"; 
                public static $TABLE			= "workflow_commitee"; 
                public static $DB_STRUCTURE = null;
                // public static $copypast = true;

                public function __construct(){
                        parent::__construct("workflow_commitee","id","workflow");
                        WorkflowWorkflowCommiteeAfwStructure::initInstance($this);
                        
                }

                public static function loadById($id)
                {
                        $obj = new WorkflowCommitee();
                        
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