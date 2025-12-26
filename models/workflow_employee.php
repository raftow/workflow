<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table workflow_orgunit : workflow_orgunit - جهات المتابعة و إعداداتها 
// ------------------------------------------------------------------------------------
// alter table ".$server_db_prefix."workflow.workflow_employee add   admin char(1) DEFAULT NULL  after service_mfk;
// update ".$server_db_prefix."workflow.workflow_employee set admin = 'N';
                
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class WorkflowEmployee extends WorkflowObject
{
        public static $orgListOfEmployee = [];

        // public static $MY_ATABLE_ID= ??; 
        // 117 CRM_INVESTIGATOR	محقق خدمة العملاء			
        public static $JOBROLE_CRM_INVESTIGATOR =  117;
        // 118 CRM_CONTROLLER	مراقب خدمة العملاء			
        public static $JOBROLE_CRM_CONTROLLER =  118;
        // 119 CRM_SUPERVISION	الإشراف العام	
        public static $JOBROLE_CRM_SUPERVISION =  119;		
        // 107 CRM_COORDINATION	مشرف تنسيق
        public static $JOBROLE_CRM_COORDINATION =  107;

     
        
	public static $DATABASE		= ""; 
        public static $MODULE		    = "workflow"; 
        public static $TABLE			= "workflow_employee"; 
        public static $DB_STRUCTURE = null;
        
        public function __construct(){
		parent::__construct("workflow_employee","id","workflow");
                WorkflowWorkflowEmployeeAfwStructure::initInstance($this);  
                
	}

        
        /*
        public static function resetAll()
        {
           $obj = new WorkflowEmployee();
           $obj->setForce("active", "N");
           $obj->setForce("admin", "N");
           return $obj->update(false);           
        }
        */

        public static function loadById($id)
        {
           $obj = new WorkflowEmployee();
           // $obj->select_visibilite_horizontale();
           if($obj->load($id))
           {
                return $obj;
           }
           else return null;
        }
        
        public function select_visibilite_horizontale($dropdown=false)
        {
                $objme = AfwSession::getUserConnected();
                
                if($objme and $objme->isAdmin()) 
                {
                        // no VH for system admin
                }
                else
                {
                        /*
                        $empl_id = $objme ? $objme->getEmployeeId() : 0;
                        
                        if($empl_id) $iam_general_supervisor = WorkflowObject::userIsGeneralCommitee();
                        if($empl_id) $iam_supervisor = WorkflowObject::userIsCommitee();
                        
                        if(!$iam_general_supervisor) $iam_general_supervisor = 0;
                        if(!$iam_supervisor) $iam_supervisor = 0;

                        // if the user is an employee 
                        // he is allowed to see workflow employee if :
                        // 1. he is a general commitee 
                        // or
                        // 2. he is a commitee

                        $employee_allowed_to_see_workflow_employee_cond = 
                            "($iam_general_supervisor>0 or $iam_supervisor>0)";
                        $this->where("($empl_id>0 and $employee_allowed_to_see_workflow_employee_cond)");     
                        */
                        $this->where("1=0"); 

                }
                        
                $selects = array();
                $this->select_visibilite_horizontale_default($dropdown, $selects);
        }
        
        /**
         * @return WorkflowEmployee
         */
        
        public static function loadByMainIndex($orgunit_id, $employee_id, $create_obj_if_not_found=false)
        {
           $obj = new WorkflowEmployee();
           if(!$orgunit_id) throw new AfwRuntimeException("loadByMainIndex : orgunit_id is mandatory field");
           if(!$employee_id) throw new AfwRuntimeException("loadByMainIndex : employee_id is mandatory field");


           $obj->select("orgunit_id",$orgunit_id);
           $obj->select("employee_id",$employee_id);

           if($obj->load())
           {
                if(!$obj->getVal("service_category_mfk")) $obj->set("service_category_mfk", ",1,");
                if(!$obj->getVal("service_mfk")) $obj->set("service_mfk", ",1,");                 
                if(!$obj->getVal("requests_nb")) $obj->set("requests_nb", 15);                 
                
		
                if($create_obj_if_not_found) $obj->activate();
                return $obj;
           }
           elseif($create_obj_if_not_found)
           {
                $obj->set("orgunit_id",$orgunit_id);
                $obj->set("employee_id",$employee_id);
                $obj->set("service_category_mfk", ",1,");
                $obj->set("service_mfk", ",1,");
                $obj->set("requests_nb", 15);                 

                $obj->insert();
                $obj->is_new = true;
                return $obj;
           }
           else return null;
           
        }


        /**
         * @return WorkflowEmployee
         */
        public static function findWorkflowEmployee($employee_id, $orgunit_id=0)
        {
                if(!$orgunit_id) $orgunit_id = WorkflowEmployee::orgOfEmployee($employee_id, false, true);
                return WorkflowEmployee::checkExistance($orgunit_id, $employee_id);
        }
        
        /**
         * @return WorkflowEmployee
         */

        public static function checkExistance($orgunit_id, $employee_id)
        {
                if(!$orgunit_id) return null;
                if(!$employee_id) return null;

                return self::loadByMainIndex($orgunit_id, $employee_id, $create_obj_if_not_found=false);
        }



        public function getDisplay($lang="ar")
        {
               
               $data = array();
               $link = array();
               

               list($data[0],$link[0]) = $this->displayAttribute("employee_id",false, $lang);
               list($data[1],$link[1]) = $this->displayAttribute("orgunit_id",false, $lang);

               
               return implode(" - ",$data);
        }

        public function getShortDisplay($lang="ar")
        {
               return $this->showAttribute("employee_id");
        }


        
        
        
        

        
        protected function getOtherLinksArray($mode, $genereLog = false, $step="all")      
        {
             global $me, $objme, $lang;
             $otherLinksArray = $this->getOtherLinksArrayStandard($mode, false, $step);
             $my_id = $this->getId();
             $displ = $this->getDisplay($lang);
             
             
             
             return $otherLinksArray;
        }
        
        protected function getPublicMethods()
        {
            
            $pbms = array();
            
            $color = "green";
            $title_ar = "اشعرني بايميل"; 
            $methodName = "notifyMe"; 
            $pbms[AfwStringHelper::hzmEncode($methodName)] = array("METHOD"=>$methodName,
                                "COLOR"=>$color, "LABEL_AR"=>$title_ar, 
                                "PUBLIC"=>true, "BF-ID"=>"", 'STEP' => 1,
                                
                                /*'CONFIRMATION_NEEDED'=>true,
                                'CONFIRMATION_QUESTION' =>  array('ar' => "سيتم انشاء حساب حقيقي لهذا العميل على أنه مكتب رحلات هل أنت متأكد", 
                                                                'en' => "You will create travel company. Sure ?"),
                                'CONFIRMATION_WARNING' => array('ar' => "من المفروض أن تكون تواصلت مع العميل وتأكدت من جديته بارسال البيانات الضروروية", 
                                                                'en' => "please check data is correct bedore and this company exists"),*/

                
                        );
            
            
            
            return $pbms;
        }
        
        
        


        public function afterInsert($id, $fields_updated, $disableAfterCommitDBEvent=false) 
        {
                if($this->sureIs("active") and ($this->getVal("employee_id")>0))
                {
                        $empl = $this->het("employee_id");
                        if($empl)
                        {
                                $empl->addMeThisJobrole(self::$JOBROLE_CRM_INVESTIGATOR);
                                $empl->updateMyUserInformation();
                        }
                }
        }

        public function afterUpdate($id, $fields_updated, $disableAfterCommitDBEvent=false) 
        {
                if(($this->getVal("employee_id")>0) and 
                   ($fields_updated["active"] or /*$fields_updated["admin"] or $fields_updated["super_admin"] or */
                    $fields_updated["requests_nb"]))
                {
                        $empl = $this->het("employee_id");
                        /*
                        if($this->sureIs("active"))
                        {
                                
                                if($this->sureIs("super_admin"))
                                {
                                     //
                                     $empl->addMeThisJobrole(self::$JOBROLE_CRM_INVESTIGATOR);
                                     $empl->addMeThisJobrole(self::$JOBROLE_CRM_COORDINATION);
                                     $empl->addMeThisJobrole(self::$JOBROLE_CRM_CONTROLLER);
                                     $empl->addMeThisJobrole(self::$JOBROLE_CRM_SUPERVISION);
                                     $empl->updateMyUserInformation();    
                                }
                                elseif($this->sureIs("admin"))
                                {
                                        $empl->addMeThisJobrole(self::$JOBROLE_CRM_INVESTIGATOR);
                                        $empl->addMeThisJobrole(self::$JOBROLE_CRM_COORDINATION);
                                        $empl->addMeThisJobrole(self::$JOBROLE_CRM_CONTROLLER);
                                        $empl->removeMeThisJobrole(self::$JOBROLE_CRM_SUPERVISION);
                                        $empl->updateMyUserInformation();    
                                }
                                else
                                {
                                        $empl->addMeThisJobrole(self::$JOBROLE_CRM_INVESTIGATOR);
                                        $empl->removeMeThisJobrole(self::$JOBROLE_CRM_COORDINATION);
                                        $empl->removeMeThisJobrole(self::$JOBROLE_CRM_CONTROLLER);
                                        $empl->removeMeThisJobrole(self::$JOBROLE_CRM_SUPERVISION);
                                        $empl->updateMyUserInformation();    
                                } 

                        }
                        else
                        {
                                $empl->removeMeThisJobrole(self::$JOBROLE_CRM_COORDINATION);
                                $empl->removeMeThisJobrole(self::$JOBROLE_CRM_SUPERVISION);
                                $empl->removeMeThisJobrole(self::$JOBROLE_CRM_CONTROLLER);
                                $empl->updateMyUserInformation();    
                                // has been disabled so remove all ongoing assigned tickets   
                                $this->removeMeAllAssigned();
                        }
                        */ 

                        // WorkflowRequest::assignCommiteeForNonAssigned(false,true);
                }
        }


        private function removeMeAllAssigned()
        {
            $obj = new WorkflowRequest();

            $me_id = $this->getVal("employee_id");
            $me_org_id = $this->getVal("orgunit_id");


            $obj->where("supervisor_id = $me_id");
            $obj->where("status_id not in (6,7,8,9)");
            $obj->setForce("supervisor_id",0);
            $obj->update(false);


            
            $obj->where("(employee_id = $me_id and orgunit_id = $me_org_id)");
            $obj->where("status_id in (2,4)");
            $obj->setForce("employee_id",0);
            $obj->setForce("orgunit_id",0);
            $status_comment = "removeMeAllAssigned me_id=".$me_id;
            $obj->setForce("status_comment", $status_comment);
            $obj->update(false);
        }
        
        public function beforeDelete($id,$id_replace) 
        {
            
            
            if($id)
            {   
               if($id_replace==0)
               {
                   $server_db_prefix = AfwSession::config("db_prefix","default_db_"); // FK part of me - not deletable 

                        
                   $server_db_prefix = AfwSession::config("db_prefix","default_db_"); // FK part of me - deletable 

                   
                   // FK not part of me - replaceable 

                        
                   
                   // MFK

               }
               else
               {
                        $server_db_prefix = AfwSession::config("db_prefix","default_db_"); // FK on me 

                        
                        // MFK

                   
               } 
               return true;
            }    
	    }


        


        public function  calcWorkflow_orgunit_id()        
        {
                if(!$this->getVal("orgunit_id")) return null;
                $obj = WorkflowOrgunit::loadByMainIndex($this->getVal("orgunit_id"));
                return $obj;
        }

        


        public function calcWorkflowRequests_count($only_done=false, $ongoing_only=false)
        {
            if(!$this->getVal("employee_id")) return null;

            $employee_id = $this->getVal("employee_id");
            $orgunit_id = $this->getVal("orgunit_id");

            $obj = new WorkflowRequest();
            $obj->select("employee_id", $employee_id);
            $obj->select("orgunit_id", $orgunit_id);

            if($only_done) $obj->where("status_id in (0,0,0) -- statsuses done to do");
            elseif($ongoing_only) $obj->where("status_id in (0,0,0,0) statsuses ongoing to do");

            // if($satisfied_only) $obj->where("service_satisfied = 'Y'");
            // if($surveyed_only) $obj->where("survey_sent = 'Y'");

            return $obj->count();
        }

        public function calcDone_requests_count($satisfied_only=false, $surveyed_only=false)
        {
                return $this->calcWorkflowRequests_count($only_done=true, $ongoing_only=false, $satisfied_only, $surveyed_only);
        }

        public function calcDoneSurveyed_requests_count($satisfied_only=false)
        {
                return $this->calcDone_requests_count($satisfied_only, $surveyed_only=true);
        }

        public function calcDoneSurveyedSatisfied_requests_count()
        {
                return $this->calcDoneSurveyed_requests_count($satisfied_only=true);
        }

        public function calcOngoing_requests_count($satisfied_only=false, $surveyed_only=false)
        {
                return $this->calcWorkflowRequests_count($only_done=false, $ongoing_only=true, $satisfied_only, $surveyed_only);
        }

        

        public function calcInbox_count()
        {
                if(!$this->getVal("employee_id")) return null;
                $myEmplId = $this->getVal("employee_id");
                /*
                if(WorkflowEmployee::isAdmin($myEmplId)) 
                {
                        $where_sql = "((".WorkflowRequest::inboxSqlCond("commitee", $myEmplId, "").") or (".WorkflowWorkflowRequest::inboxSqlCond("employee", $myEmplId, "")."))";
                }
                else
                {
                        $where_sql = WorkflowRequest::inboxSqlCond("employee", $myEmplId, "");
                }
                */
                $where_sql = WorkflowRequest::inboxSqlCond("employee", $myEmplId, "");

                $obj = new WorkflowWorkflowRequest();
                $obj->where($where_sql);

                return $obj->count();
        }


        public function calcStatif_pct()
        {
            $all_count = $this->calcDoneSurveyed_requests_count();
            if(!$all_count) return null;
            $satisfied_only_count = $this->calcDoneSurveyedSatisfied_requests_count();
            

            return round($satisfied_only_count*100/$all_count);
        }

        public static function getCommiteeArray($orgunit_id, $commitee_id)
        {
                $obj = new WorkflowEmployee();
                // $obj->select_visibilite_horizontale();
                $obj->select("orgunit_id",$orgunit_id);
                $obj->select("commitee_id", $commitee_id);
                $obj->select("active", 'Y');

                return $obj->loadMany();
        }

        public static function getCommiteeList($orgunit_id, $commitee_id)
        {
                
                $objList = self::getCommiteeArray($orgunit_id, $commitee_id);

                $supervList = array();

                foreach($objList as $objItem)
                {
                        $supervList[$objItem->getVal("employee_id")] = array('obj' => $objItem, 'curr' => 0);   // ->getDisplay("ar")
                }
                return $supervList;
        }

        /*
        public static function isAdmin($employee_id)
        {
                $obj = new WorkflowEmployee();
                $obj->select("admin","Y");
                $obj->select("employee_id",$employee_id);
                $obj->load();
                return $obj->id;

        }


        public static function isGeneralAdmin($employee_id)
        {
                $obj = new WorkflowEmployee();
                $obj->select("super_admin","Y");
                $obj->select("employee_id",$employee_id);
                $obj->load();
                return $obj->id;

        }

        */

        public static function getInvestigatorListOfIds($orgunit_id)
        {
                $invList = self::getInvestigatorList($orgunit_id);

                $invListIds = array();
                foreach($invList as $id => $invObj)
                {
                        $invListIds[] = $invObj->id;
                }

                return array($invListIds, $invList);
        }

        public static function getInvestigatorList($orgunit_id, $except_investigator_id=0)
        {
                $obj = new WorkflowEmployee();
                if(!$orgunit_id) $obj->simpleError("getInvestigatorList need a correct and valid orgunit_id");
                // $obj->select_visibilite_horizontale();
                $obj->select("orgunit_id",$orgunit_id);
                $obj->select("active", 'Y');
                $obj->where("super_admin = 'N' and employee_id != $except_investigator_id");  
                // admin = 'N' and // rafik 30/8/2022 : I removed this from above acondition because admin (مشرف تنسيق) can be a commitee 
                
                
                $objList = AfwLoadHelper::loadList($obj, "employee_id");

                return $objList;
        }

        public static function getInvestigatorArray($orgunit_id, $except_investigator_id=0)
        {
                $obj = new WorkflowEmployee();
                if(!$orgunit_id) $obj->simpleError("getInvestigatorList need a correct and valid orgunit_id");
                // $obj->select_visibilite_horizontale();
                $obj->select("orgunit_id",$orgunit_id);
                $obj->select("active", 'Y');
                $obj->where("admin = 'N' and super_admin = 'N' and employee_id != $except_investigator_id");
                
                $objList = $obj->loadMany();

                $investList = array();

                foreach($objList as $objItem)
                {
                        $investList[$objItem->getVal("employee_id")] = array('obj' => $objItem, 'curr' => 0);   // ->getDisplay("ar")
                }
                return $investList;
        }


        public static function orgOfEmployee($employee_id, $return_object=false, $return_id = true)
        {
                if(!self::$orgListOfEmployee[$employee_id])
                {
                        $obj = new WorkflowEmployee();
                        // $obj->select_visibilite_horizontale();
                        $obj->select("employee_id",$employee_id);
                        $obj->select("active", 'Y');
                        
                        self::$orgListOfEmployee[$employee_id] = AfwLoadHelper::loadList($obj, "orgunit_id");
                }
                
                $objList = self::$orgListOfEmployee[$employee_id];

                if(count($objList)==1)
                {
                        foreach($objList as $objItem) 
                        {
                                if($return_object) return  $objItem;
                                elseif($return_id) return $objItem->id;
                                else 
                                {
                                        $lang = AfwSession::getSessionVar("current_lang");
                                        if(!$lang) $lang = "ar";
                                        return AfwLanguageHelper::tt("المنسق(ـة) في") . " " . $objItem->getDisplay($lang);
                                }
                        }                
                }
                elseif(count($objList)>1)
                {
                        if($return_object) return  null;
                        elseif($return_id) return 0;
                        else 
                        {
                                $lang = AfwSession::getSessionVar("lang");
                                if(!$lang) $lang = "ar";
                                return "<div class='workflow-warning'>".AfwLanguageHelper::tt("معين في أكثر من جهة متابعة",$lang)."</div>";
                        }
                }
                else
                {
                        if($return_object) return  null;
                        elseif($return_id) return 0;
                        else 
                        {
                                $lang = AfwSession::getSessionVar("lang");
                                if(!$lang) $lang = "ar";
                                return "<div class='workflow-warning'>".AfwLanguageHelper::tt("غير معين في جهة متابعة",$lang)."</div>";
                        }
                }
        }

        public static function getBestAvailableInvestigator($orgunit_id, $except_investigator_id=0)
        {
                $investigatorList = self::getInvestigatorArray($orgunit_id);
                if($except_investigator_id) unset($investigatorList[$except_investigator_id]);
                else $except_investigator_id=0;
                // AfwRunHelper::safeDie("investigatorList = ".var_export($investigatorList,true));
                $stats_arr = WorkflowRequest::aggreg($function="count(*)", $where=" active='Y' 
                                                                                and status_id in (0,0,) --REQUEST_STATUSES_ONGOING_INVESTIGATOR
                                                                                and orgunit_id=$orgunit_id 
                                                                                and employee_id > 0 
                                                                                and employee_id != $except_investigator_id", $group_by = "employee_id",
                                                                $throw_error=true, $throw_analysis_crash=true);
                // AfwRunHelper::safeDie("stats_arr = ".var_export($stats_arr,true));
                $best_investigator_id = 0;
                if(count($stats_arr)>0)
                {
                        $min_curr_count = 99999;
                        
                        foreach($stats_arr as $investigator_id => $curr_count)
                        {
                                $investigatorList[$investigator_id]["curr"] = $curr_count;
                                if(($curr_count < $min_curr_count) and ($investigatorList[$investigator_id]["obj"]))
                                {
                                        $min_curr_count = $curr_count;
                                        $best_investigator_id = $investigator_id; 
                                }

                        }
                }

                // but if one licensor doesn't have any previous request assigned he will not be in $stats_arr 
                // he should be the best_licensor because he have no request assigned, so check this :
                foreach($investigatorList as $investigator_id => $investigatorItem)
                {
                        if(!$investigatorItem["curr"]) $best_investigator_id = $investigator_id; 
                }


                
                
                if((!$best_investigator_id) or (!$investigatorList[$best_investigator_id]["obj"]))
                {
                        reset($investigatorList);
                        $first_item = current($investigatorList);
                        // AfwRunHelper::safeDie("first_item = ".var_export($first_item,true)." investigatorList = ".var_export($investigatorList,true));
                        if($first_item["obj"]) $best_investigator_id = $first_item["obj"]->getVal("employee_id");
                }

                if($best_investigator_id) $return = $investigatorList[$best_investigator_id];
                else $return = null;

                // die("best_investigator_id = $best_investigator_id , return = ".var_export($return,true).", investigatorList = ".var_export($investigatorList,true));

                return array($best_investigator_id, $return, $investigatorList);

                
                
                
        }

        /*
        public static function getBestAvailableCommitee($orgunit_id, $except_supervisor_id=0, $re_distribution=false)
        {
                global $allCommiteeList;
                if(!$allCommiteeList) $allCommiteeList = self::getCommiteeList($orgunit_id);                
                $supervisorList = $allCommiteeList;
                if($except_supervisor_id) unset($supervisorList[$except_supervisor_id]);
                else $except_supervisor_id=0;                 
                // AfwRunHelper::safeDie("supervisorList = ".var_export($supervisorList,true));
                $best_supervisor_id = 0;


                $stats_arr = WorkflowRequest::aggreg($function="count(*)", $where="active='Y' and status_id in (".WorkflowRequest::$REQUEST_STATUSES_ONGOING_SUPERVISOR.") and supervisor_id > 0 and supervisor_id != $except_supervisor_id", $group_by = "supervisor_id",$throw_error=true, $throw_analysis_crash=true);                                        
                if(count($stats_arr)>0)
                {
                        foreach($stats_arr as $superv_id => $curr_count)
                        {
                                $supervisorList[$superv_id]["curr"] = $curr_count;
                        }
                }



                $min_curr_count = 99999;

                foreach($supervisorList as $superv_id => $supervisorRow)
                {
                        $curr_count = $supervisorRow["curr"];
                        if(($curr_count < $min_curr_count) and ($supervisorRow["obj"]))
                        {
                                $min_curr_count = $curr_count;
                                $best_supervisor_id = $superv_id; 
                        }
                }


                if((!$best_supervisor_id) or (!$supervisorList[$best_supervisor_id]["obj"]))
                {
                        reset($supervisorList);
                        $first_item = current($supervisorList);
                        // AfwRunHelper::safeDie("first_item = ".var_export($first_item,true)." supervisorList = ".var_export($supervisorList,true));
                        if($first_item["obj"]) $best_supervisor_id = $first_item["obj"]->getVal("employee_id");
                }

                if($best_supervisor_id) $return = $supervisorList[$best_supervisor_id];
                else $return = null;

                // AfwRunHelper::safeDie("best_supervisor_id = $best_supervisor_id , return = ".var_export($return,true));

                return array($best_supervisor_id, $return, $supervisorList, $stats_arr);

                
                
                
        }


        public function assignMeAsWorkflowRequestCommitee($requestObj, $commit = true) // , $orgunit_id
        {
                // $requestObj->set("orgunit_id", $orgunit_id);
                $requestObj->set("supervisor_id", $this->getVal("employee_id"));
                if($commit) $requestObj->commit();
        }

        */

        /**
         * @param WorkflowRequest $requestObj
         */

        public function assignMeAsWorkflowRequestInvestigator($requestObj, $lang="ar")
        {
                list($err, $info) = $requestObj->assignWorkflowRequest($this->getVal("employee_id"), $lang, "Y", "assignMeAsWorkflowRequestInvestigator");
                if($err) AfwSession::pushError($err);
                if($info) AfwSession::pushInformation($info); 
        }

        public function calcArchive_date()
        {                
		return AfwDateHelper::shiftHijriDate("",-180);
        }


        protected function hideNonActiveRowsFor($auser)
        {
                if(!$auser) return true;
                if(WorkflowObject::userIsSuperAdmin($auser)) return false;
                if($auser->isAdmin()) return false;  
                return true;
        }

        public function shouldBeCalculatedField($attribute){
                if($attribute=="email") return true;
                if($attribute=="mobile") return true;
                
                return false;
        }

        public function myShortNameToAttributeName($attribute)
        {
                if ($attribute == "employee") return "employee_id";
                
                return $attribute;
        }



        public static function notifyWorkflowEmployees($silent = false, $lang="ar")
        {
                $server_db_prefix = AfwSession::config("db_prefix", "default_db_");
                $sql_inbox = "select orgunit_id, employee_id, count(*) as waiting from $server_db_prefix"."workflow.request where status_id in (201,4) group by orgunit_id, employee_id order by count(*) desc";
                // $sql_inbox .= " limit 30";

                $inbox_data = AfwDatabase::db_recup_rows($sql_inbox);

                $errors_arr = array();
                $infos_arr = array();

                foreach($inbox_data as $inbox_row)
                {
                        $token_arr=[];
                        $token_arr["[waiting]"] = $inbox_row["waiting"];
                        $token_arr["[workflow_site_url]"] = AfwSession::config("workflow_site_url", "[workflow-site]");
                        $token_arr["[workflow_general_admin]"] = AfwSession::config("workflow_general_admin", "rboubaker@ttc.gov.sa");

                        $workflowEmployeeObj = WorkflowEmployee::loadByMainIndex($inbox_row["orgunit_id"],$inbox_row["employee_id"]);
                        list($err, $info) = $workflowEmployeeObj->notifyMe($lang, $token_arr);
                        if ($err) $errors_arr[] = $err;
                        if ($info) $infos_arr[] = $info;
                }

                $nb_errs = count($errors_arr);

                $infos_arr[] = "notified " . count($inbox_data) . " employee(s) with $nb_errs error(s)";

                if ((!$silent) and (count($errors_arr) > 0)) {
                        AfwSession::pushError(implode("<br>", $errors_arr));
                }

                if ((!$silent) and (count($infos_arr) > 0)) {
                        AfwSession::pushInformation(implode("<br>", $infos_arr));
                }

                return AfwFormatHelper::pbm_result($errors_arr, $infos_arr);
        }

        public function notifyMe($lang = "ar", $token_arr=[])
        {       
                $employeeObj = $this->het("employee_id");
                if(!$employeeObj) return ["This workflow employee has no hrm employee defined : workflow-employee-id=".$this->id, ""];
                 
                $my_employee_id = $employeeObj->id;
                if(count($token_arr)==0)
                {
                        $token_arr=[];
                        $server_db_prefix = AfwSession::config("db_prefix", "default_db_");
                        $sql_inbox = "select orgunit_id, employee_id, count(*) as waiting from $server_db_prefix"."workflow.request where employee_id = $my_employee_id and status_id in (201,4) group by orgunit_id, employee_id";

                        $inbox_row = AfwDatabase::db_recup_row($sql_inbox);
                        $token_arr["[waiting]"] = $inbox_row["waiting"];
                        $token_arr["[workflow_site_url]"] = AfwSession::config("workflow_site_url", "[workflow-site]");
                        $token_arr["[workflow_general_admin]"] = AfwSession::config("workflow_general_admin", "rboubaker@ttc.gov.sa");                                                
                }

                $token_arr["[the_orgunit]"] = $this->showAttribute("orgunit_id",null,true,$lang);

                $errors_arr = array();
                $infos_arr = array();

                $notify_employee_arr = AfwSession::config("notify_employee", null);
                $notify_employee_daily_waiting_requests_settings = $notify_employee_arr["daily_waiting_requests"];
                $development_mode = AfwSession::devMode();
                $receiver = array();
                
                $receiver["mobile"] = $employeeObj->getVal("mobile");
                $receiver["email"] = $employeeObj->getVal("email");
                // $receiver["mobile"] = "0598988330";
                // $receiver["email"] = "rboubaker@ttc.gov.sa";

                // $cc_to = "rboubaker@ttc.gov.sa";
                $cc_to = null;

                $file_dir_name = dirname(__FILE__);

                $from_template_file = "$file_dir_name/../tpl/template_[notification_type]_[notification_code].php";

                
                $receiver_label = $receiver["email"]."/".$receiver["mobile"];
                $notification_sender_result_arr = AfwNotificationManager::sendNotification($notify_employee_daily_waiting_requests_settings, $receiver, "waiting_requests_notification", $employeeObj, $lang, $from_template_file, $token_arr, $cc_to);
                foreach ($notification_sender_result_arr as $notification_type => $notification_sender_result_item) {
                        $notification_sender_result_ok = $notification_sender_result_item[0];
                        $notification_sender_result_message = $notification_sender_result_item[1];
                        $notification_message = $notification_sender_result_item[2];
                        if (!$notification_sender_result_ok) {
                                $notif_error = $this->tr($notification_type) . " &larr; " . $notification_message . " &larr; " . $notification_sender_result_message;   
                                if($development_mode) AfwSession::pushError($notif_error);
                                $errors_arr[] = $notif_error;
                        }
                        else 
                        {
                                $notif_info = $this->tr($notification_type) . " &larr; " . $notification_message . " &larr; " . $notification_sender_result_message ." >> sent successfully to $receiver_label";      
                                $infos_arr[]  = $notif_info;
                        }
                }


                return AfwFormatHelper::pbm_result($errors_arr, $infos_arr);
        }
             
}
?>