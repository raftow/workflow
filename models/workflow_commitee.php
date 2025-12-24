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

                protected function getOtherLinksArray($mode, $genereLog = false, $step = "all")
                {
                        $lang = AfwLanguageHelper::getGlobalLanguage();
                        // $objme = AfwSession::getUserConnected();
                        // $me = ($objme) ? $objme->id : 0;

                        $otherLinksArray = $this->getOtherLinksArrayStandard($mode, $genereLog, $step);
                        $my_id = $this->getId();
                        $displ = $this->getDisplay($lang);

                        if ($mode == "mode_workflowCommiteeScopeList") {
                        unset($link);
                        $link = array();
                        $title = "إضافة برنامج جديد";
                        $title_detailed = $title . "لـ : " . $displ;
                        $link["URL"] = "main.php?Main_Page=afw_mode_edit.php&cl=WorkflowCommiteeScope&currmod=workflow&sel_workflow_commitee_id=$my_id";
                        $link["TITLE"] = $title;
                        $link["UGROUPS"] = array();
                        $otherLinksArray[] = $link;
                        }



                        // check errors on all steps (by default no for optimization)
                        // rafik don't know why this : \//  = false;

                        return $otherLinksArray;
                }

        }
?>