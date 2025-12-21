<?php
class WorkflowModel extends WorkflowObject
{

        public static $DATABASE                = "";
        public static $MODULE                    = "workflow";
        public static $TABLE                        = "workflow_model";
        public static $DB_STRUCTURE = null;
        // public static $copypast = true;

        public function __construct()
        {
                parent::__construct("workflow_model", "id", "workflow");
                WorkflowWorkflowModelAfwStructure::initInstance($this);
        }

        public static function loadById($id)
        {
                $obj = new WorkflowModel();

                if ($obj->load($id)) {
                        return $obj;
                } else return null;
        }

        /**
         * @return WorkflowModel
         */

        public static function loadByMainIndex($external_code, $create_obj_if_not_found = false)
        {
                if (!$external_code) throw new AfwRuntimeException("loadByMainIndex : external_code is mandatory field");


                $obj = new WorkflowModel();
                $obj->select("external_code", $external_code);

                if ($obj->load()) {
                        if ($create_obj_if_not_found) $obj->activate();
                        return $obj;
                } elseif ($create_obj_if_not_found) {
                        $obj->set("external_code", $external_code);

                        $obj->insertNew();
                        if (!$obj->id) return null; // means beforeInsert rejected insert operation
                        $obj->is_new = true;
                        return $obj;
                } else return null;
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
                $mod_id = $this->getVal("workflow_module_id");
                $displ = $this->getDisplay($lang);



                if ($mode == "mode_workflowStageList") {
                        unset($link);
                        $link = array();
                        $title = "إضافة مرحلة جديدة";
                        $title_detailed = $title . "لـ : " . $displ;
                        $link["URL"] = "main.php?Main_Page=afw_mode_edit.php&cl=WorkflowStage&currmod=workflow&sel_workflow_model_id=$my_id";
                        $link["TITLE"] = $title;
                        $link["UGROUPS"] = array();
                        $otherLinksArray[] = $link;
                }

                if ($mode == "mode_workflowTransitionList") {
                        unset($link);
                        $link = array();
                        $title = "إضافة تحول جديد";
                        $title_detailed = $title . "لـ : " . $displ;
                        $link["URL"] = "main.php?Main_Page=afw_mode_edit.php&cl=WorkflowTransition&currmod=workflow&sel_workflow_model_id=$my_id&sel_workflow_module_id=$mod_id";
                        $link["TITLE"] = $title;
                        $link["UGROUPS"] = array();
                        $otherLinksArray[] = $link;
                }



                // check errors on all steps (by default no for optimization)
                // rafik don't know why this : \//  = false;

                return $otherLinksArray;
        }


        public function displayTransitionTreeview()
        {
                $lang = AfwLanguageHelper::getGlobalLanguage();
                $root_node_display = $this->decode("workflow_module_id", '', false, $lang);
                $node_display = $this->getNodeDisplay($lang);
                $html_items = "";
                $this_node_id = "m".$this->getId();
                $workflowTransitionList = $this->get("workflowTransitionList");
                $workflowActionList = [];
                $workflowStatusList = [];
                $workflowStageDone = [];
                $workflowStageOrdered = [];
                foreach($workflowTransitionList as $workflowTransitionItem)
                {
                        $workflowStageObject = $workflowTransitionItem->het("initial_stage_id");
                        if($workflowStageObject) 
                        {
                                if(!$workflowStageDone[$workflowStageObject->id])
                                {
                                        $workflowStatusObj = $workflowTransitionItem->het("initial_status_id");
                                        $workflowStatusList[$workflowStageObject->id][$workflowStatusObj->id] = $workflowStatusObj;
                                        $workflowActionObj = $workflowTransitionItem->het("workflow_action_id");
                                        $workflowActionList[$workflowStageObject->id][$workflowStatusObj->id][$workflowActionObj->id] = $workflowActionObj;
                                        $workflowStageDone[$workflowStageObject->id] = true;
                                        $workflowStageOrdered[] = $workflowStageObject;
                                }
                                
                        }
                }        

                $my_first_child_stage_id = null;
                $previous_node = null;
                foreach($workflowStageOrdered as $so => $workflowStage)
                {
                        $myWorkflowStatusList = $workflowStatusList[$workflowStage->id];
                        if((!$myWorkflowStatusList) or (count($myWorkflowStatusList) == 0))
                        {
                                die("my workflowStatusList for stage $workflowStage->id is empty => $workflowStatusList = ".var_export($workflowStatusList, true));
                        }
                        /**
                         * @var WorkflowStage $workflowStage
                         */
                        list($my_node_id, $node_html) = $workflowStage->displayTreeviewDiv($lang, $this_node_id, $myWorkflowStatusList, $workflowActionList[$workflowStageObject->id]);
                        if($previous_node)
                        {
                                $html_items = str_replace("[next-of-$previous_node]", $my_node_id, $html_items);       
                        }
                        if(!$my_first_child_stage_id) $my_first_child_stage_id = $my_node_id;
                        $html_items .= "\n". $node_html;
                        $previous_node = $my_node_id;
                }

                if($previous_node)
                {
                        $html_items = str_replace("[next-of-$previous_node]", "", $html_items);       
                }

                return "<div dir='rtl' id='treemain' style='direction: rtl;'>
                        <div id='node_0' class='window hiddon module'
                                data-id='0'
                                data-parent=\"\"
                                data-first-child=\"$this_node_id\"
                                data-next-sibling=\"\">
                        $root_node_display
                        </div>
                        <div id='node_$this_node_id' class='window hiddon model'
                                data-id='$this_node_id'
                                data-parent=\"0\"
                                data-first-child=\"$my_first_child_stage_id\"
                                data-next-sibling=\"\">
                        $node_display
                        <span class='count app module'>60</span>
                        </div>

                        $html_items
                </div>";
        }
}
