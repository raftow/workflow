<?php 

                
$file_dir_name = dirname(__FILE__); 
                
// require_once("$file_dir_name/../afw/afw.php");

class SlotModel extends AFWObject{

        public static $MY_ATABLE_ID=14063; 
  
        public static $DATABASE		= "nauss_workflow";
        public static $MODULE		        = "workflow";        
        public static $TABLE			= "slot_model";

	    public static $DB_STRUCTURE = null;
	
	    public function __construct(){
		parent::__construct("slot_model","id","workflow");
            WorkflowSlotModelAfwStructure::initInstance($this);    
	    }
        
        public static function loadById($id)
        {
           $obj = new SlotModel();
           $obj->select_visibilite_horizontale();
           if($obj->load($id))
           {
                return $obj;
           }
           else return null;
        }
        
        

        public function getScenarioItemId($currstep)
                {
                    
                    return 0;
                }
        
         public static function loadByMainIndex($interview_type_pattern_id, $workflow_session_id, $interview_date,$create_obj_if_not_found=false)
        {
           if(!$interview_type_pattern_id) throw new AfwRuntimeException("loadByMainIndex : interview_type_pattern_id is mandatory field");
           if(!$workflow_session_id) throw new AfwRuntimeException("loadByMainIndex : workflow_session_id is mandatory field");
           if(!$interview_date) throw new AfwRuntimeException("loadByMainIndex : interview_date is mandatory field");


           $obj = new SlotModel();
           $obj->select("interview_type_pattern_id",$interview_type_pattern_id);
           $obj->select("workflow_session_id",$workflow_session_id);
           $obj->select("interview_date",$interview_date);

           if($obj->load())
           {
                if($create_obj_if_not_found) $obj->activate();
                return $obj;
           }
           elseif($create_obj_if_not_found)
           {
                $obj->set("interview_type_pattern_id",$interview_type_pattern_id);
                $obj->set("workflow_session_id",$workflow_session_id);
                $obj->set("interview_date",$interview_date);

                $obj->insertNew();
                if(!$obj->id) return null; // means beforeInsert rejected insert operation
                $obj->is_new = true;
                return $obj;
           }
           else return null;
           
        }

        public function getDisplay($lang="ar")
        {
               
        }
        
        
        

        
        protected function getOtherLinksArray($mode,$genereLog=false,$step="all")      
        {
             $lang = AfwLanguageHelper::getGlobalLanguage();
             // $objme = AfwSession::getUserConnected();
             // $me = ($objme) ? $objme->id : 0;

             $otherLinksArray = $this->getOtherLinksArrayStandard($mode,$genereLog,$step);
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
        
        

        public function beforeMaj($id, $fields_updated)
        {
            return true;
        }            
        public function afterMaj($id, $fields_updated)
        {
            $this->generateInterviewSlots();
            return true;
        }
        
        public function beforeDelete($id,$id_replace) 
        {
            $server_db_prefix = AfwSession::config("db_prefix","nauss_");
            
            if(!$id)
            {
                $id = $this->getId();
                $simul = true;
            }
            else
            {
                $simul = false;
            }
            
            if($id)
            {   
               if($id_replace==0)
               {
                   // FK part of me - not deletable 

                        
                   // FK part of me - deletable 

                   
                   // FK not part of me - replaceable 

                        
                   
                   // MFK

               }
               else
               {
                        // FK on me 

                        
                        // MFK

                   
               } 
               return true;
            }    
	}
     
    public function list_of_interview_type()
    {
        $lang = AfwLanguageHelper::getGlobalLanguage();
        return self::interview_type()[$lang];
    }
    public static function interview_type()
    {
            $arr_list_of_interview_type = array();
            
                    
            $arr_list_of_interview_type["en"][1] = "Onsite";
            $arr_list_of_interview_type["ar"][1] = "حضوري";
            $arr_list_of_interview_type["code"][1] = "ONS";

            $arr_list_of_interview_type["en"][2] = "Virtual";
            $arr_list_of_interview_type["ar"][2] = "عن بعد";
            $arr_list_of_interview_type["code"][2] = "VIR";



            return $arr_list_of_interview_type;
    }


    public function generateInterviewSlots()
    {
        $objInterbiewPattern = $this->het("interview_type_pattern_id");
        
        
        $slot_model_id = $this->id;
        $interview_date = $this->getVal("interview_date");
        $start_time = $this->getVal("start_time");
        $end_time = $this->getVal("end_time");
        $single_duration = $this->getVal("single_duration");


        $start = new DateTime("$interview_date $start_time");
        $end   = new DateTime("$interview_date $end_time");
        $interval = new DateInterval("PT{$single_duration}M");
        $buffer_minutes = $this->getVal("buffer_minutes");
        if($buffer_minutes && is_numeric($buffer_minutes) && $buffer_minutes>0)
        {
            $buffer_interval = new DateInterval("PT{$buffer_minutes}M");
        }
        else
        {
            $buffer_interval = null;
        }


        while ($start < $end) {
            $slot_start = $start->format('H:i');
            $start->add($interval);
            if ($start > $end) {
                break;
            }

            $slot_end = $start->format('H:i');

            $objInterviewSlot = InterviewSlot::loadByMainIndex($slot_model_id, $interview_date, $start_time,true);
            $objInterviewSlot->set("slot_model_id", $this->getId());
            $objInterviewSlot->set("interview_date", $this->getVal("interview_date"));
            $objInterviewSlot->set("start_time", $slot_start);
            $objInterviewSlot->set("end_time", $slot_end);
            $objInterviewSlot->set("duration", $this->getVal("duration"));
            $objInterviewSlot->set("capacity", $this->getVal("capacity"));
            $objInterviewSlot->set("booked_seats_count", $this->getVal("booked_seats_count"));
            $objInterviewSlot->set("interview_type", $this->getVal("interview_type"));
            $objInterviewSlot->set("location", $this->getVal("location"));
            $objInterviewSlot->set("virtual_meeting_url", $this->getVal("virtual_meeting_url"));
            $objInterviewSlot->set("workflow_commitee_id", $this->getVal("workflow_commitee_id"));
            $objInterviewSlot->set("interview_slot_status_id", 1);
            $objInterviewSlot->commit();
            if($buffer_interval>0)
            {
                $start->add($buffer_interval);
            }

        }
     

        
    }
}


