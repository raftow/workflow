<?php
        class NotificationSchedule extends WorkflowObject{

                public static $DATABASE		= ""; 
                public static $MODULE		    = "workflow"; 
                public static $TABLE			= "notification_schedule"; 
                public static $DB_STRUCTURE = null;
                // public static $copypast = true;

                public function __construct(){
                        parent::__construct("notification_schedule","id","workflow");
                        WorkflowNotificationScheduleAfwStructure::initInstance($this);
                        
                }

                public static function loadById($id)
                {
                        $obj = new NotificationSchedule();
                        
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

        }
?>