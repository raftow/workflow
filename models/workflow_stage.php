<?php
class WorkflowStage extends WorkflowObject
{

        public static $DATABASE                = "";
        public static $MODULE                    = "workflow";
        public static $TABLE                        = "workflow_stage";
        public static $DB_STRUCTURE = null;
        // public static $copypast = true;

        public function __construct()
        {
                parent::__construct("workflow_stage", "id", "workflow");
                WorkflowWorkflowStageAfwStructure::initInstance($this);
        }

        public static function loadById($id)
        {
                $obj = new WorkflowStage();

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

        public function displayTreeviewDiv($lang, $parent_node_id, $workflowStatusList, $workflowActionList)
        {
                $node_display = $this->getNodeDisplay($lang);
                $node_id = "s" . $this->id;

                $html_children = "";
                $my_first_child_status_id = null;
                $previous_node = null;
                foreach ($workflowStatusList as $workflowStatusObj) {
                        $myWorkflowActionList = $workflowActionList[$workflowStatusObj->id];                                
                                /*
                                if((($this->id==1) and ($workflowStatusObj->id==1)))
                                {
                                        die("stage $this->id status $workflowStatusObj->id myWorkflowActionList[$workflowStatusObj->id] = ".var_export($myWorkflowActionList, true)." workflowActionList = ".var_export($workflowActionList, true));
                                }
                                
                                if((!$myWorkflowActionList) or (!is_array($myWorkflowActionList)) or (count($myWorkflowActionList)==0))
                                {
                                        die("stage $this->id status $workflowStatusObj->id workflowActionList = ".var_export($workflowActionList, true)." myWorkflowActionList[$workflowStatusObj->id] = ".var_export($myWorkflowActionList, true));
                                }*/
                        /**
                         * @var WorkflowStatus $workflowStatusObj
                         */
                        $arrResult = $workflowStatusObj->displayTreeviewDiv($lang, $node_id, $myWorkflowActionList);
                        list($my_node_id, $node_html) = $arrResult;
                        // if(!$node_html) die("workflowStatusObj($workflowStatusObj->id)->displayTreeviewDiv($lang, $node_id, myWorkflowActionList)")
                        if ($previous_node) {
                                $html_children = str_replace("[next-of-$previous_node]", $my_node_id, $html_children);
                        }
                        if (!$my_first_child_status_id) $my_first_child_status_id = $my_node_id;
                        $html_children .= $node_html;
                        $previous_node = $my_node_id;
                }

                if ($previous_node) {
                        $html_children = str_replace("[next-of-$previous_node]", "", $html_children);
                }

                // die("html_children of stage $node_id = ".$html_children."  workflowStatusList = ".var_export($workflowStatusList, true)."");

                return [
                        $node_id,
                        "<div id='node_$node_id' class='window hiddon stage'
                                data-id='$node_id'
                                data-parent=\"$parent_node_id\"
                                data-first-child=\"$my_first_child_status_id\"
                                data-next-sibling=\"[next-of-$node_id]\">
                        $node_display
                        <br><span class='count app stage'>10</span>
                        </div>
                        $html_children
                        "
                ];
        }

        public function convenientOrgunitForScope($workflow_scope_id)
        {
                $department_academic_review_according_to_program = 12420;
                $orgunit_id = $this->getVal("orgunit_id");
                if ($orgunit_id == $department_academic_review_according_to_program) {
                        $workflow_role_id = $this->getVal("workflow_role_id");

                        $server_db_prefix = AfwSession::currentDBPrefix();

                        // find list of commitees having this role and the workflow_scope_id
                        $rows = AfwDatabase::db_recup_rows("select id from $server_db_prefix" . "workflow.workflow_commitee where active = 'Y' and workflow_role_id=$workflow_role_id");
                        $ids = "0";
                        foreach ($rows as $row) $ids .= "," . $row['id'];
                        // between these commitees select the ones having the wanted scope
                        $wcs = new workflowCommiteeScope();
                        $wcs->where("workflow_commitee_id in ($ids) and workflow_scope_id = $workflow_scope_id");

                        $wcsList = $wcs->loadMany();

                        // @todo select the committee having lowest charge
                        // for the moment IO will take the first one because normally only one for nauss by role
                        foreach ($wcsList as $wcsItem) {
                                if ($wcsItem) {
                                        $commItem = $wcsItem->het("workflow_commitee_id");
                                        $orgunit_id = $commItem->getVal("orgunit_id");
                                        break;
                                }
                        }
                }

                return $orgunit_id;
        }
}
