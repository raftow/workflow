<?php
        class NotificationTemplate extends WorkflowObject{

                public static $DATABASE		= ""; 
                public static $MODULE		    = "workflow"; 
                public static $TABLE			= "notification_template"; 
                public static $DB_STRUCTURE = null;
                // public static $copypast = true;

                public function __construct(){
                        parent::__construct("notification_template","id","workflow");
                        WorkflowNotificationTemplateAfwStructure::initInstance($this);
                        
                }

                public static function loadById($id)
                {
                        $obj = new NotificationTemplate();
                        
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

                public function list_of_recipient_type_enum()
                {
                        $lang = AfwLanguageHelper::getGlobalLanguage();
                        return self::recipient_type_enum()[$lang];
                }
                public static function recipient_type_enum()
                {
                        $arr_list_of_recipient_type = array();
                        
                                
                        $arr_list_of_recipient_type["en"][1] = "applicant";
                        $arr_list_of_recipient_type["ar"][1] = "المتقدم";
                        $arr_list_of_recipient_type["code"][1] = "APPL";

                        $arr_list_of_recipient_type["en"][2] = "Admin-staff";
                        $arr_list_of_recipient_type["ar"][2] = "الموظف الإداري";
                        $arr_list_of_recipient_type["code"][2] = "ADMN";

                        return $arr_list_of_recipient_type;
                }

        }
?>