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

        public static function loadByMainIndex($external_code,$create_obj_if_not_found=false)
        {
           if(!$external_code) throw new AfwRuntimeException("loadByMainIndex : external_code is mandatory field");


           $obj = new WorkflowModel();
           $obj->select("external_code",$external_code);

           if($obj->load())
           {
                if($create_obj_if_not_found) $obj->activate();
                return $obj;
           }
           elseif($create_obj_if_not_found)
           {
                $obj->set("external_code",$external_code);

                $obj->insertNew();
                if(!$obj->id) return null; // means beforeInsert rejected insert operation
                $obj->is_new = true;
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
                $mod_id = $this->getVal("workflow_module_id");
                $displ = $this->getDisplay($lang);

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
}
