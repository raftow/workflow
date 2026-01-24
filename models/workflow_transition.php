<?php


$file_dir_name = dirname(__FILE__);

// require_once("$file_dir_name/../afw/afw.php");

class WorkflowTransition extends WorkflowObject
{

    public static $MY_ATABLE_ID = 14017;

    public static $DATABASE        = "nauss_workflow";
    public static $MODULE                = "workflow";
    public static $TABLE            = "workflow_transition";

    public static $DB_STRUCTURE = null;

    public function __construct()
    {
        parent::__construct("workflow_transition", "id", "workflow");
        WorkflowWorkflowTransitionAfwStructure::initInstance($this);
    }

    public static function loadById($id)
    {
        $obj = new WorkflowTransition();
        $obj->select_visibilite_horizontale();
        if ($obj->load($id)) {
            return $obj;
        } else return null;
    }



    public function getScenarioItemId($currstep)
    {
        return 0;
    }


    public function displayTreeviewDiv($lang)
    {
        $node_display = $this->getNodeDisplay($lang);
        $node_id = $this->id;
        return "<div id='node_1' class='window hidden'
             data-id='1'
             data-parent='0'
             data-first-child='4'
             data-next-sibling='2'>
             $node_display
        </div>";
    }


    public function getNodeDisplay($lang = "ar")
    {
        $actionObj = $this->het("workflow_action_id");
        if (!$actionObj) return $this->getDisplay($lang) . " !!!!";
        return $actionObj->getDisplay($lang);
    }





    protected function getOtherLinksArray($mode, $genereLog = false, $step = "all")
    {
        $lang = AfwLanguageHelper::getGlobalLanguage();
        // $objme = AfwSession::getUserConnected();
        // $me = ($objme) ? $objme->id : 0;

        $otherLinksArray = $this->getOtherLinksArrayStandard($mode, $genereLog, $step);
        $my_id = $this->getId();
        $displ = $this->getDisplay($lang);



        // check errors on all steps (by default no for optimization)
        // rafik don't know why this : \//  = false;

        return $otherLinksArray;
    }

    protected function getPublicMethods()
    {

        $pbms = array();

        $color = "green";
        $title_ar = "xxxxxxxxxxxxxxxxxxxx";
        $methodName = "mmmmmmmmmmmmmmmmmmmmmmm";
        //$pbms[AfwStringHelper::hzmEncode($methodName)] = array("METHOD"=>$methodName,"COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true, "BF-ID"=>"", 'STEP' =>$this->stepOfAttribute("xxyy"));



        return $pbms;
    }

    public function fld_CREATION_USER_ID()
    {
        return "created_by";
    }

    public function fld_CREATION_DATE()
    {
        return "created_at";
    }

    public function fld_UPDATE_USER_ID()
    {
        return "updated_by";
    }

    public function fld_UPDATE_DATE()
    {
        return "updated_at";
    }

    public function fld_VALIDATION_USER_ID()
    {
        return "validated_by";
    }

    public function fld_VALIDATION_DATE()
    {
        return "validated_at";
    }

    public function fld_VERSION()
    {
        return "version";
    }

    public function fld_ACTIVE()
    {
        return  "active";
    }

    /*
        public function isTechField($attribute) {
            return (($attribute=="created_by") or 
                    ($attribute=="created_at") or 
                    ($attribute=="updated_by") or 
                    ($attribute=="updated_at") or 
                    // ($attribute=="validated_by") or ($attribute=="validated_at") or 
                    ($attribute=="version"));  
        }*/


    public function beforeDelete($id, $id_replace)
    {
        $server_db_prefix = AfwSession::config("db_prefix", "nauss_");

        if (!$id) {
            $id = $this->getId();
            $simul = true;
        } else {
            $simul = false;
        }

        if ($id) {
            if ($id_replace == 0) {
                // FK part of me - not deletable 


                // FK part of me - deletable 


                // FK not part of me - replaceable 



                // MFK

            } else {
                // FK on me 


                // MFK


            }
            return true;
        }
    }


    public static function requestsCanBeTransittedByWRoleSqlCondition($wrole_id)
    {
        $server_db_prefix = AfwSession::currentDBPrefix();
        $rows = AfwDatabase::db_recup_rows("select initial_stage_id, initial_status_id from $server_db_prefix" . "workflow.`workflow_transition` where workflow_role_mfk like '%,$wrole_id,%'");


        $cond_sql_arr = [];

        $cond_sql_arr[] = "0 -- for wrole $wrole_id \n";

        foreach ($rows as $row) {
            $initial_stage_id = $row['initial_stage_id'];
            $initial_status_id = $row['initial_status_id'];
            $cond_sql_arr[] = "(workflow_stage_id = $initial_stage_id and workflow_status_id = $initial_status_id)";
        }

        $cond_sql = implode(" or ", $cond_sql_arr);

        return $cond_sql;
    }


    public function getColor()
    {
        $actionObj = $this->het("workflow_action_id");
        if (!$actionObj) return "black";
        $action_type_enum = $actionObj->getVal("action_type_enum");
        $return = self::color_of_action($action_type_enum);

        //  die("$return = self::color_of_action($action_type_enum);");

        return $return;
    }

    public function switcherConfig($col, $auser = null)
    {
        $lang = AfwLanguageHelper::getGlobalLanguage();

        $switcher_authorized = false;
        $switcher_title = "";
        $switcher_text = "";

        if ($col == $this->fld_ACTIVE()) {
            $switcher_authorized = true;
        }

        if ($col == "condition_before") {
            $switcher_authorized = true;
            $switcher_title = $this->tm("Are you sure ?", $lang);
            $switcher_text = $this->tm("This will show/hide the button before check the condition", $lang);
        }

        return [$switcher_authorized, $switcher_title, $switcher_text];
    }
}
