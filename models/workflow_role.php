<?php
        class WorkflowRole extends WorkflowObject{

                public static $DATABASE		= ""; 
                public static $MODULE		    = "workflow"; 
                public static $TABLE			= "workflow_role"; 
                public static $DB_STRUCTURE = null;
                // public static $copypast = true;

                public function __construct(){
                        parent::__construct("workflow_role","id","workflow");
                        WorkflowWorkflowRoleAfwStructure::initInstance($this);
                        
                }

                public static function loadById($id)
                {
                        $obj = new WorkflowRole();
                        
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

                public function shouldBeCalculatedField($attribute){
                        if($attribute=="domain1_enum") return true;
                        if($attribute=="domain2_enum") return true;
                        if($attribute=="domain3_enum") return true;
                        if($attribute=="domain4_enum") return true;
                        return false;
                }

        }
?>