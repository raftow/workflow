<?php
        class WorkflowTask extends WorkflowObject{

                public static $DATABASE		= ""; 
                public static $MODULE		    = "workflow"; 
                public static $TABLE			= "workflow_task"; 
                public static $DB_STRUCTURE = null;
                // public static $copypast = true;

                public function __construct(){
                        parent::__construct("workflow_task","id","workflow");
                        WorkflowWorkflowTaskAfwStructure::initInstance($this);
                        
                }

                public static function loadById($id)
                {
                        $obj = new WorkflowTask();
                        
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
