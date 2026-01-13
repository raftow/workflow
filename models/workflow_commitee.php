<?php
class WorkflowCommitee extends WorkflowObject
{

        public static $DATABASE                = "";
        public static $MODULE                    = "workflow";
        public static $TABLE                        = "workflow_commitee";
        public static $DB_STRUCTURE = null;
        // public static $copypast = true;

        public function __construct()
        {
                parent::__construct("workflow_commitee", "id", "workflow");
                WorkflowWorkflowCommiteeAfwStructure::initInstance($this);
        }

        public static function loadById($id)
        {
                $obj = new WorkflowCommitee();

                if ($obj->load($id)) {
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

        public function calcWscope_mfk($what = "value")
        {

                $workflowCommiteeScopeList = $this->get("workflowCommiteeScopeList");
                if ($what == "value") {
                        $result = ",";

                        foreach ($workflowCommiteeScopeList as $workflowCommiteeScope) {
                                $result .= $workflowCommiteeScope->getVal("workflow_scope_id") . ",";
                        }
                } elseif ($what == "object") {
                        $result = [];

                        foreach ($workflowCommiteeScopeList as $workflowCommiteeScope) {
                                if ($workflowCommiteeScope->getVal("workflow_scope_id") > 0) $result[$workflowCommiteeScope->getVal("workflow_scope_id")] = $workflowCommiteeScope->het("workflow_scope_id");
                        }
                } elseif ($what == "decodeme") {
                        $result = "";

                        foreach ($workflowCommiteeScopeList as $workflowCommiteeScope) {
                                /**
                                 * @var WorkflowCommiteeScope $workflowCommiteeScope
                                 */
                                $result .= $workflowCommiteeScope->decode("workflow_scope_id") . "/";
                        }
                        $result = trim($result, "/");
                }

                return $result;
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

                if ($mode == "mode_workflowCommiteeMemberList") {
                        unset($link);
                        $link = array();
                        $title = "إضافة عضو لجنة جديد";
                        $title_detailed = $title . "لـ : " . $displ;
                        $link["URL"] = "main.php?Main_Page=afw_mode_edit.php&cl=WorkflowCommiteeMember&currmod=workflow&sel_workflow_commitee_id=$my_id";
                        $link["TITLE"] = $title;
                        $link["UGROUPS"] = array();
                        $otherLinksArray[] = $link;
                }




                // check errors on all steps (by default no for optimization)
                // rafik don't know why this : \//  = false;

                return $otherLinksArray;
        }


        public function afterInsert($id, $fields_updated, $disableAfterCommitDBEvent = false)
        {
                $this->updateOrgunit($lang = "ar");
                return parent::afterInsert($id, $fields_updated, $disableAfterCommitDBEvent);
        }


        public function afterMaj($id, $fields_updated)
        {
                // update the related orgunit and workflow orgunit
                if (($fields_updated["commitee_name_ar"] or $fields_updated["commitee_name_en"]) and
                        $this->id and
                        $this->getVal("commitee_name_ar") and
                        $this->getVal("commitee_name_en")
                ) {
                        $this->updateOrgunit($lang = "ar");
                }

                if ($fields_updated["secretary_employee_id"]) {
                        $emplObj = $this->het("secretary_employee_id");
                }
        }

        public function getOrgunitInfos()
        {
                $hrm_code = "commitee-" . $this->id;
                $orgunitObj = Orgunit::loadByHRMCode($hrm_code);
                $wOrgunitObj = null;
                if ($orgunitObj) {
                        $wOrgunitObj = WorkflowOrgunit::loadByMainIndex($orgunitObj->id, true);
                }

                return [$orgunitObj, $wOrgunitObj];
        }

        public function updateOrgunit($lang = "ar")
        {
                if (!$this->id) return ["No orgunit for empty commitee", ""];
                $hrm_code = "commitee-" . $this->id;

                $parent_orgunit_id = 1;
                $id_sh_org = 1;
                $id_sh_type = OrgunitType::$ORGUNIT_TYPE_DIVISION;
                $id_domain = Domain::$DOMAIN_ADMISSION;

                $titre_short_ar = $titre_ar = $this->getVal("commitee_name_ar");
                $titre_short_en = $titre_en = $this->getVal("commitee_name_en");

                $orgunitObj = Orgunit::findOrgunit(
                        $id_sh_type,
                        $id_sh_org,
                        $hrm_code,
                        $titre_short_ar,
                        $titre_ar,
                        $titre_short_en,
                        $titre_en,
                        $id_domain,
                        $hrm_crm = "hrm",
                        $create_obj_if_not_found = true
                );


                $orgunitObj->set("gender_id", 1);
                $orgunitObj->set("id_sh_parent", $parent_orgunit_id);
                $orgunitObj->commit();
                $this->set("orgunit_id", $orgunitObj->getId());
                $this->commit();

                WorkflowOrgunit::loadByMainIndex($orgunitObj->id, true);
        }
}
