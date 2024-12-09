<?php 

// require_once("$file_dir_name/../afw/afw.php");

class IntelligentContent extends WorkflowObject{

        public static $MY_ATABLE_ID=13940; 
  
        public static $DATABASE		= "pmu_workflow";
        public static $MODULE		        = "workflow";        
        public static $TABLE			= "intelligent_content";

	    public static $DB_STRUCTURE = null;
	
	    public function __construct(){
		parent::__construct("intelligent_content","id","workflow");
            WorkflowIntelligentContentAfwStructure::initInstance($this);    
	    }
        
        public static function loadById($id)
        {
           $obj = new IntelligentContent();
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
        
        public static function loadByMainIndex($module_id, $lookup_code, $content_type_enum,$create_obj_if_not_found=false)
        {
           if(!$module_id) throw new AfwRuntimeException("loadByMainIndex : module_id is mandatory field");
           if(!$lookup_code) throw new AfwRuntimeException("loadByMainIndex : lookup_code is mandatory field");
           if(!$content_type_enum) throw new AfwRuntimeException("loadByMainIndex : content_type_enum is mandatory field");


           $obj = new IntelligentContent();
           $obj->select("module_id",$module_id);
           $obj->select("lookup_code",$lookup_code);
           $obj->select("content_type_enum",$content_type_enum);

           if($obj->load())
           {
                if($create_obj_if_not_found) $obj->activate();
                return $obj;
           }
           elseif($create_obj_if_not_found)
           {
                $obj->set("module_id",$module_id);
                $obj->set("lookup_code",$lookup_code);
                $obj->set("content_type_enum",$content_type_enum);

                $obj->insertNew();
                if(!$obj->id) return null; // means beforeInsert rejected insert operation
                $obj->is_new = true;
                return $obj;
           }
           else return null;
           
        }


        public function getDisplay($lang="ar")
        {
               return $this->getVal("name_$lang");
        }
        
        
        
/*        public function list_of_content_type_enum() { 
            $list_of_items = array(); 
            $list_of_items[1] = "";  //     code : ... not defined ... 
           return  $list_of_items;
        } 


*/
        
        protected function getOtherLinksArray($mode,$genereLog=false,$step="all")      
        {
             global $lang;
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
        
        





    public function beforeDelete($id, $id_replace)
    {
        $server_db_prefix = AfwSession::config("db_prefix", "pmu_");

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
                // workflow.content_item-ãÍÊæì ÇáÐßí	intelligent_content_id  ÍÞá íÝáÊÑ Èå
                if (!$simul) {
                    // require_once "../workflow/content_item.php";
                    ContentItem::updateWhere(array('intelligent_content_id' => $id_replace), "intelligent_content_id='$id'");
                    // $this->execQuery("update ${server_db_prefix}workflow.content_item set intelligent_content_id='$id_replace' where intelligent_content_id='$id' ");
                }



                // MFK

            } else {
                // FK on me 
                // workflow.content_item-ãÍÊæì ÇáÐßí	intelligent_content_id  ÍÞá íÝáÊÑ Èå
                if (!$simul) {
                    // require_once "../workflow/content_item.php";
                    ContentItem::updateWhere(array('intelligent_content_id' => $id_replace), "intelligent_content_id='$id'");
                    // $this->execQuery("update ${server_db_prefix}workflow.content_item set intelligent_content_id='$id_replace' where intelligent_content_id='$id' ");
                }


                // MFK


            }
            return true;
        }
    }
}



// errors 
