<?php


$file_dir_name = dirname(__FILE__);

// require_once("$file_dir_name/../afw/afw.php");

class Notification extends AFWObject
{

        public static $MY_ATABLE_ID = 13975;

        public static $DATABASE                = "";
        public static $MODULE                        = "workflow";
        public static $TABLE                        = "notification";
        /**
         * DB_STRUCTURE is the main source of configuration for the class 
         *    it is used in all the modules and methods to know how 
         *    to handle the class attributes
         * @var array|null
         */
        public static $DB_STRUCTURE = null;

        public function __construct()
        {
                parent::__construct("notification", "id", "workflow");
                WorkflowNotificationAfwStructure::initInstance($this);
        }
        /**
         * @param mixed $id
         * @return Notification
         */
        public static function loadById($id)
        {
                $obj = new Notification();
                $obj->select_visibilite_horizontale();
                if ($obj->load($id)) {
                        return $obj;
                } else return null;
        }



        public function getScenarioItemId($currstep)
        {
                if ($currstep == 1) return 355;

                return 0;
        }

        /**
         * @param int $workflow_module_id
         * @param int $workflow_entity_id
         * @param int $workflow_event_id
         * @param string $event_date
         * @param int $destination_id
         * @param int $notification_template_id
         * @param bool $create_obj_if_not_found
         * @return Notification|null
         */

        public static function loadByMainIndex($workflow_module_id, $workflow_entity_id, $workflow_event_id, $event_date, $destination_id, $notification_template_id=0, $create_obj_if_not_found = false)
        {
                if (!$workflow_module_id) throw new AfwRuntimeException("loadByMainIndex : workflow_module_id is mandatory field");
                if (!$workflow_entity_id) throw new AfwRuntimeException("loadByMainIndex : workflow_entity_id is mandatory field");
                if (!$workflow_event_id) throw new AfwRuntimeException("loadByMainIndex : workflow_event_id is mandatory field");
                if (!$event_date) $event_date = date("Y-m-d H:i:s");
                if (!$destination_id) throw new AfwRuntimeException("loadByMainIndex : destination_id is mandatory field");


                $obj = new Notification();
                $obj->select("workflow_module_id", $workflow_module_id);
                $obj->select("workflow_entity_id", $workflow_entity_id);
                $obj->select("workflow_event_id", $workflow_event_id);
                $obj->select("event_date", $event_date);
                $obj->select("destination_id", $destination_id);
                $obj->select("notification_template_id", $notification_template_id);

                if ($obj->load()) {
                        if ($create_obj_if_not_found) $obj->activate();
                        return $obj;
                } elseif ($create_obj_if_not_found) {
                        $obj->set("workflow_module_id", $workflow_module_id);
                        $obj->set("workflow_entity_id", $workflow_entity_id);
                        $obj->set("workflow_event_id", $workflow_event_id);
                        $obj->set("event_date", $event_date);
                        $obj->set("destination_id", $destination_id);
                        $obj->set("notification_template_id", $notification_template_id);

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
                /*
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
                );*/



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

        public function calcThe_body($what='value')
        {
                $notification_body = $this->getVal("notification_body");
                $notification_title = $this->getVal("notification_title");

                if($this->sureIs("sent")) {
                        $sent_phrase = "تم الارسال في " . $this->getVal("sent_date");
                }
                else {
                        $sent_phrase = "لم يتم الارسال بعد";
                }

                return "<div class='notification-details'>
                                <div class='notification-title'>$notification_title</div>
                                <div class='notification-body'>$notification_body</div>
                                <div class='notification-sent'>$sent_phrase</div>
                </div>";
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
