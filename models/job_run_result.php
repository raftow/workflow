<?php

class JobRunResult extends AFWObject{

        public static $MY_ATABLE_ID=3609; 
        // إجراء إحصائيات حول نتائج تنفيذات المهام الآلية 
        public static $BF_STATS_JOB_RUN_RESULT = 103894; 
        // إدارة نتائج تنفيذات المهام الآلية 
        public static $BF_QEDIT_JOB_RUN_RESULT = 103889; 
        // إنشاء نتيجة تنفيذ مهمة آلية 
        public static $BF_EDIT_JOB_RUN_RESULT = 103888; 
        // الاستعلام عن نتيجة تنفيذ مهمة آلية 
        public static $BF_QSEARCH_JOB_RUN_RESULT = 103893; 
        // البحث في نتائج تنفيذات المهام الآلية 
        public static $BF_SEARCH_JOB_RUN_RESULT = 103892; 
        // عرض تفاصيل نتيجة تنفيذ مهمة آلية 
        public static $BF_DISPLAY_JOB_RUN_RESULT = 103891; 
        // مسح نتيجة تنفيذ مهمة آلية 
        public static $BF_DELETE_JOB_RUN_RESULT = 103890; 

        
	public static $DB_STRUCTURE = array (
          
     );
	
	public function __construct(){
		parent::__construct("job_run_result","id","workflow");
          WorkflowJobRunResultAfwStructure::initInstance($this);      
	}
        
        public static function loadById($id)
        {
           $obj = new JobRunResult();
           $obj->select_visibilite_horizontale();
           if($obj->load($id))
           {
                return $obj;
           }
           else return null;
        }
        
        
        
        public static function loadByMainIndex($job_run_id, $item, $result_code,$create_obj_if_not_found=false)
        {
           $obj = new JobRunResult();
           if(!$job_run_id) $obj->_error("loadByMainIndex : job_run_id is mandatory field");
           if(!$item) $obj->_error("loadByMainIndex : item is mandatory field");
           if(!$result_code) $obj->_error("loadByMainIndex : result_code is mandatory field");


           $obj->select("job_run_id",$job_run_id);
           $obj->select("item",$item);
           $obj->select("result_code",$result_code);

           if($obj->load())
           {
                if($create_obj_if_not_found) $obj->activate();
                return $obj;
           }
           elseif($create_obj_if_not_found)
           {
                $obj->set("job_run_id",$job_run_id);
                $obj->set("item",$item);
                $obj->set("result_code",$result_code);

                $obj->insert();
                $obj->is_new = true;
                return $obj;
           }
           else return null;
           
        }


        public function getDisplay($lang="ar")
        {
               
               $data = array();
               $link = array();
               

               list($data[0],$link[0]) = $this->displayAttribute("job_run_id",false, $lang);
               list($data[1],$link[1]) = $this->displayAttribute("result_code",false, $lang);

               
               return implode(" - ",$data);
        }
        
        
        

        
        protected function getOtherLinksArray($mode, $genereLog = false, $step = "all")
        {
             global $me, $objme, $lang;
             $otherLinksArray = array();
             $my_id = $this->getId();
             $displ = $this->getDisplay($lang);
             
             
             
             return $otherLinksArray;
        }
        
        protected function getPublicMethods()
        {
            
            $pbms = array();
            
            $color = "green";
            $title_ar = "xxxxxxxxxxxxxxxxxxxx"; 
            //$pbms["xc123B"] = array("METHOD"=>"methodName","COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true, "BF-ID"=>"");
            
            
            
            return $pbms;
        }
        
        
        public function beforeDelete($id,$id_replace) 
        {
            global $server_db_prefix;
            
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
?>