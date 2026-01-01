<?php 

                
$file_dir_name = dirname(__FILE__); 
                
// require_once("$file_dir_name/../afw/afw.php");

class InterviewBooking extends AFWObject{

        public static $MY_ATABLE_ID=14071; 
  
        public static $DATABASE		= "nauss_workflow";
        public static $MODULE		        = "workflow";        
        public static $TABLE			= "interview_booking";

	    public static $DB_STRUCTURE = null;
	
	    public function __construct(){
		parent::__construct("interview_booking","id","workflow");
            WorkflowInterviewBookingAfwStructure::initInstance($this);    
	    }
        
        public static function loadById($id)
        {
           $obj = new InterviewBooking();
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
        
         public static function loadByMainIndex($workflow_applicant_id, $workflow_session_id, $interview_type_pattern_id,$create_obj_if_not_found=false)
        {
           if(!$workflow_applicant_id) throw new AfwRuntimeException("loadByMainIndex : workflow_applicant_id is mandatory field");
           if(!$workflow_session_id) throw new AfwRuntimeException("loadByMainIndex : workflow_session_id is mandatory field");
           if(!$interview_type_pattern_id) throw new AfwRuntimeException("loadByMainIndex : interview_type_pattern_id is mandatory field");


           $obj = new InterviewBooking();
           $obj->select("workflow_applicant_id",$workflow_applicant_id);
           $obj->select("workflow_session_id",$workflow_session_id);
           $obj->select("interview_type_pattern_id",$interview_type_pattern_id);

           if($obj->load())
           {
                if($create_obj_if_not_found) $obj->activate();
                return $obj;
           }
           elseif($create_obj_if_not_found)
           {
                $obj->set("workflow_applicant_id",$workflow_applicant_id);
                $obj->set("workflow_session_id",$workflow_session_id);
                $obj->set("interview_type_pattern_id",$interview_type_pattern_id);

                $obj->insertNew();
                if(!$obj->id) return null; // means beforeInsert rejected insert operation
                $obj->is_new = true;
                return $obj;
           }
           else return null;
           
        }

        public static function addNewInterviewBooking($workflow_applicant_id, $workflow_session_id, $interview_type_pattern_id, $workflow_scope_id,$workflow_request_id, $reschedule_ind='Y')
        {
            $interviewBookingObj = self::loadByMainIndex($workflow_applicant_id, $workflow_session_id, $interview_type_pattern_id, true);
            if($interviewBookingObj){
                $interviewBookingObj->set("booking_status_id",6);
                $interviewBookingObj->set("workflow_scope_id",$workflow_scope_id);
                $interviewBookingObj->set("can_reschedule_ind",$reschedule_ind);
                $interviewBookingObj->set("workflow_request_id",$workflow_request_id);
                
                $interviewBookingObj->set("reschedule_count",0);
                $interviewBookingObj->set("can_cancel_ind",'N');
                $interviewBookingObj->commit();
            }

           
            return $interviewBookingObj;
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
             
}


