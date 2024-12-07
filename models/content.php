<?php 

                
$file_dir_name = dirname(__FILE__); 
                
// require_once("$file_dir_name/../afw/afw.php");

class Content extends AFWObject{

        public static $MY_ATABLE_ID=13936; 
  
        public static $DATABASE		= "pmu_workflow";
        public static $MODULE		        = "workflow";        
        public static $TABLE			= "content";

	    public static $DB_STRUCTURE = null;
	
	    public function __construct(){
		parent::__construct("content","id","workflow");
            WorkflowContentAfwStructure::initInstance($this);    
	    }
        
        public static function loadById($id)
        {
           $obj = new Content();
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
             
             if($mode=="mode_contentItemList")
             {
                   unset($link);
                   $link = array();
                   $title = "إضافة عنصر محتوى جديد";
                   $title_detailed = $title ."لـ : ". $displ;
                   $link["URL"] = "main.php?Main_Page=afw_mode_edit.php&cl=ContentItem&currmod=workflow&sel_content_id=$my_id";
                   $link["TITLE"] = $title;
                   $link["UGROUPS"] = array();
                   $otherLinksArray[] = $link;
             }
             
             
             
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
        
        public function isTechField($attribute) {
            return (($attribute=="created_by") or ($attribute=="created_at") or ($attribute=="updated_by") or ($attribute=="updated_at") or ($attribute=="validated_by") or ($attribute=="validated_at") or ($attribute=="version"));  
        }
        
        
        public function beforeDelete($id,$id_replace) 
        {
            $server_db_prefix = AfwSession::config("db_prefix","pmu_");
            
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
                       // workflow.page_section-المحتوى	content_id  حقل يفلتر به
                        if(!$simul)
                        {
                            // require_once "../workflow/page_section.php";
                            PageSection::removeWhere("content_id='$id'");
                            // $this->execQuery("delete from ${server_db_prefix}workflow.page_section where content_id = '$id' ");
                            
                        } 
                        
                        
                       // workflow.content_item-المحتوى	content_id  أنا تفاصيل لها
                        if(!$simul)
                        {
                            // require_once "../workflow/content_item.php";
                            ContentItem::removeWhere("content_id='$id'");
                            // $this->execQuery("delete from ${server_db_prefix}workflow.content_item where content_id = '$id' ");
                            
                        } 
                        
                        

                   
                   // FK not part of me - replaceable 

                        
                   
                   // MFK

               }
               else
               {
                        // FK on me 
                       // workflow.page_section-المحتوى	content_id  حقل يفلتر به
                        if(!$simul)
                        {
                            // require_once "../workflow/page_section.php";
                            PageSection::updateWhere(array('content_id'=>$id_replace), "content_id='$id'");
                            // $this->execQuery("update ${server_db_prefix}workflow.page_section set content_id='$id_replace' where content_id='$id' ");
                            
                        }
                        
                       // workflow.content_item-المحتوى	content_id  أنا تفاصيل لها
                        if(!$simul)
                        {
                            // require_once "../workflow/content_item.php";
                            ContentItem::updateWhere(array('content_id'=>$id_replace), "content_id='$id'");
                            // $this->execQuery("update ${server_db_prefix}workflow.content_item set content_id='$id_replace' where content_id='$id' ");
                            
                        }
                        

                        
                        // MFK

                   
               } 
               return true;
            }    
	}
             
}

