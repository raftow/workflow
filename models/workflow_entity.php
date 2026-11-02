<?php


$file_dir_name = dirname(__FILE__);

class WorkflowEntity extends AFWObject
{

        public static $MY_ATABLE_ID = 13977;


        // lookup Value List codes 

        public static $DATABASE                = "";
        public static $MODULE                        = "workflow";
        public static $TABLE                        = "workflow_entity";
        /**
         * DB_STRUCTURE is the main source of configuration for the class 
         *    it is used in all the modules and methods to know how 
         *    to handle the class attributes
         * @var array|null
         */
        public static $DB_STRUCTURE = null;

        public function __construct()
        {
                parent::__construct("workflow_entity", "id", "workflow");
                WorkflowWorkflowEntityAfwStructure::initInstance($this);
        }
        /**
         * @param mixed $id
         * @return WorkflowEntity
         */
        public static function loadById($id)
        {
                $obj = new WorkflowEntity();
                $obj->select_visibilite_horizontale();
                if ($obj->load($id)) {
                        return $obj;
                } else return null;
        }

        public static function loadAll()
        {
                $obj = new WorkflowEntity();
                $obj->select("active", 'Y');

                $objList = $obj->loadMany();

                return $objList;
        }


        public function getScenarioItemId($currstep)
        {
                if ($currstep == 1) return 359;

                return 0;
        }

        public static function loadByMainIndex($lookup_code, $create_obj_if_not_found = false)
        {
                if (!$lookup_code) throw new AfwRuntimeException("loadByMainIndex : lookup_code is mandatory field");


                $obj = new WorkflowEntity();
                $obj->select("lookup_code", $lookup_code);

                if ($obj->load()) {
                        if ($create_obj_if_not_found) $obj->activate();
                        return $obj;
                } elseif ($create_obj_if_not_found) {
                        $obj->set("lookup_code", $lookup_code);

                        $obj->insertNew();
                        if (!$obj->id) return null; // means beforeInsert rejected insert operation
                        $obj->is_new = true;
                        return $obj;
                } else return null;
        }

        /**
         * @param AFWObject $object
         */
        public static function get_workflow_entity_id($object) {
                $workflow_module = $object->getMyModule();
                $workflow_module_id = WorkflowModule::get_workflow_module_id($workflow_module);
                if(!$workflow_module_id) return  null;
                $table_name = $object->getTableName();
                $lookup_code = $object->getMyModule().".".$table_name;

                $weObj = self::loadByMainIndex($lookup_code, $create_obj_if_not_found = true);

                if($weObj) {
                        $weObj->set("entity_name_ar", $object->transClassSingle('ar', true));
                        $weObj->set("entity_name_en", $object->transClassSingle('en', true));
                        $weObj->set("workflow_module_id", $workflow_module_id);
                        $weObj->update();
                }


                return [$workflow_module_id, $weObj->id];

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
                $title_en = "xxxxxxxxxxxxxxxxxxxx";
                $methodName = "mmmmmmmmmmmmmmmmmmmmmmm";
                //$pbms[AfwStringHelper::hzmEncode($methodName)] = 
                array(
                        "METHOD" => $methodName,
                        "COLOR" => $color,
                        "LABEL_AR" => $title_ar,
                        "LABEL_EN" => $title_en,
                        "ADMIN-ONLY" => true,
                        "BF-ID" => "",
                        'STEP' => $this->stepOfAttribute("xxyy")
                );



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



        public function beforeMaj($id, $fields_updated)
        {
                return true;
        }


        public function beforeDelete($id, $id_replace)
        {
                $server_db_prefix = AfwSession::config("db_prefix", "tvtc_");

                if (!$id) {
                        $id = $this->getId();
                        $simul = true;
                } else {
                        $simul = false;
                }

                if ($id) {
                        if ($id_replace == 0) {
                                // FK part of me - not deletable 
                                // workflow.notification-الكيان	workflow_entity_id  حقل يفلتر به (required field)
                                // require_once "../workflow/notification.php";
                                $obj = new Notification();
                                $obj->where("workflow_entity_id = '$id' and active='Y' ");
                                $nbRecords = $obj->count();
                                // check if there's no record that block the delete operation
                                if ($nbRecords > 0) {
                                        $this->deleteNotAllowedReason = "Used in some Notifications(s) as Entity";
                                        return false;
                                }
                                // if there's no record that block the delete operation perform the delete of the other records linked with me and deletable
                                if (!$simul) $obj->deleteWhere("workflow_entity_id = '$id' and active='N'");



                                // FK part of me - deletable 


                                // FK not part of me - replaceable 



                                // MFK

                        } else {
                                // FK on me 


                                // workflow.notification-الكيان	workflow_entity_id  حقل يفلتر به (required field)
                                if (!$simul) {
                                        // require_once "../workflow/notification.php";
                                        Notification::updateWhere(array('workflow_entity_id' => $id_replace), "workflow_entity_id='$id'");
                                        // $this->execQuery("update ${server_db_prefix}workflow.notification set workflow_entity_id='$id_replace' where workflow_entity_id='$id' ");

                                }




                                // MFK


                        }
                        return true;
                }
        }
}
