<?php

$file_dir_name = dirname(__FILE__);

// require_once( "$file_dir_name/../afw/afw.php" );

class WorkflowSession extends AFWObject
{

    public static $MY_ATABLE_ID = 14077;

    public static $DATABASE = 'nauss_workflow';
    public static $MODULE   = 'workflow';

    public static $TABLE = 'workflow_session';

    public static $DB_STRUCTURE = null;

    public function __construct()
    {
        parent::__construct('workflow_session', 'id', 'workflow');
        WorkflowWorkflowSessionAfwStructure::initInstance($this);

    }

    public static function loadById($id)
    {
        $obj = new WorkflowSession();
        $obj->select_visibilite_horizontale();
        if ($obj->load($id)) {
            return $obj;
        } else {
            return null;
        }

    }

    public static function loadByMainIndex($workflow_model_id, $external_code,$create_obj_if_not_found=false)
    {
        if(!$workflow_model_id) throw new AfwRuntimeException("loadByMainIndex : workflow_model_id is mandatory field");
        if(!$external_code) throw new AfwRuntimeException("loadByMainIndex : external_code is mandatory field");


        $obj = new WorkflowSession();
        $obj->select("workflow_model_id",$workflow_model_id);
        $obj->select("external_code",$external_code);

        if($obj->load())
        {
            if($create_obj_if_not_found) $obj->activate();
            return $obj;
        }
        elseif($create_obj_if_not_found)
        {
            $obj->set("workflow_model_id",$workflow_model_id);
            $obj->set("external_code",$external_code);

            $obj->insertNew();
            if(!$obj->id) return null; // means beforeInsert rejected insert operation
            $obj->is_new = true;
            return $obj;
        }
        else return null;
        
    }

    public function getScenarioItemId($currstep)
    {
        return 0;
    }

    protected function getOtherLinksArray($mode, $genereLog = false, $step = 'all')
    {
        $lang = AfwLanguageHelper::getGlobalLanguage();
        // $objme = AfwSession::getUserConnected();
        // $me = ( $objme ) ? $objme->id : 0;

        $otherLinksArray = $this->getOtherLinksArrayStandard($mode, $genereLog, $step);
        $my_id           = $this->getId();
        $displ           = $this->getDisplay($lang);

        // check errors on all steps ( by default no for optimization )
        // rafik don't know why this : \//  = false;

        return $otherLinksArray;
    }

    protected function getPublicMethods()
    {

        $pbms = [];

        $color      = "green";
        $title_ar   = "xxxxxxxxxxxxxxxxxxxx";
        $methodName = "mmmmmmmmmmmmmmmmmmmmmmm";
        //$pbms[AfwStringHelper::hzmEncode($methodName)] = array("METHOD"=>$methodName,"COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true, "BF-ID"=>"", 'STEP' =>$this->stepOfAttribute( 'xxyy' ) );

        return $pbms;
    }

    public function fld_CREATION_USER_ID()
    {
        return 'created_by';
    }

    public function fld_CREATION_DATE()
    {
        return 'created_at';
    }

    public function fld_UPDATE_USER_ID()
    {
        return 'updated_by';
    }

    public function fld_UPDATE_DATE()
    {
        return 'updated_at';
    }

    public function fld_VALIDATION_USER_ID()
    {
        return 'validated_by';
    }

    public function fld_VALIDATION_DATE()
    {
        return 'validated_at';
    }

    public function fld_VERSION()
    {
        return 'version';
    }

    public function fld_ACTIVE()
    {
        return 'active';
    }

    public function beforeMaj($id, $fields_updated)
    {
        return true;
    }

    public function beforeDelete($id, $id_replace)
    {
        $server_db_prefix = AfwSession::config('db_prefix', 'nauss_');

        if (! $id) {
            $id    = $this->getId();
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

}

// errors
