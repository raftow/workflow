<?php
// rafik 18/9/2024 : ALTER TABLE `workflow_applicant` CHANGE `id` `id` BIGINT(20) NOT NULL AUTO_INCREMENT;

class WorkflowApplicant extends WorkflowObject
{

        public static $DATABASE        = "";
        public static $MODULE            = "workflow";
        public static $TABLE            = "workflow_applicant";
        public static $DB_STRUCTURE = null;
        // public static $copypast = true;


        // big_photo - صورة تعريفية  
        public static $doc_type_big_photo = 13;

        // small_photo -   صورة صغيرة  
        public static $doc_type_small_photo = 12;

        // attachement - مرفق توضيحي
        public static $doc_type_attachement = 7;

        private $secondary_cumulative_pct = null; // do not removed it is used with $$xxx way
        private $secondary_major_path = null; // do not removed it is used with $$xxx way
        private $secondary_program_track = null; // do not removed it is used with $$xxx way
        private $aptitude_Score = null;
        private $achievement_Score = null;
        private $objSQ = null;
        private $applicantQualificationList = null;

        public $update_date = [];

        public function __construct()
        {
                parent::__construct("workflow_applicant", "id", "workflow");
                WorkflowWorkflowApplicantAfwStructure::initInstance($this);
        }


        public static function tryConvertIdnToID($value)
        {
                $idn = $value;
                list($idn_correct, $idn_type_id) = AfwFormatHelper::getIdnTypeId($idn);
                $id = null;
                if (($idn_type_id == 1) or ($idn_type_id == 2)) {
                        if (is_numeric($idn) and $idn_correct) $id = $idn;
                } 

                return $id;
        }


        public function convertIdnToID($value)
        {
                $idn = $value;
                if(!$idn) return 0;
                list($idn_correct, $idn_type_id) = AfwFormatHelper::getIdnTypeId($idn);
                if(!$idn_type_id) $idn_type_id = $this->getVal("idn_type_id");
                if(!$idn_type_id) return 0;
                
                $id = 0;
                if (($idn_type_id == 1) or ($idn_type_id == 2)) {
                        if (is_numeric($idn) and $idn_correct) $id = $idn;
                } else {
                        $country_id = $this->getSelectedValueForAttribute("country_id");
                        if(!$country_id) $country_id = $this->getVal("country_id");
                        if ($country_id) {
                                $id = IdnToId::convertToID('workflow', $country_id, $idn_type_id, $idn);
                        } else {
                                // we can not optimize query and select the id while passport number entered without country specified
                                $id = 0;
                        }
                }

                return $id;
        }
        public function afterSelect($attribute, $value)
        {
                // As we have a partion by ID and ID = IDN,
                // when we select IDN we select ID also to use the partionning concept
                if ($attribute == "idn") {
                        $id = $this->convertIdnToID($value);
                        if ($id > 0) $this->select("id", $id);
                }
        }

        public static function loadById($id)
        {
                $obj = new WorkflowApplicant();

                if ($obj->load($id)) {
                        return $obj;
                } else return null;
        }

        public static function loadByMainIndex($country_id, $idn_type_id, $idn, $create_obj_if_not_found = false)
        {
                if (!$country_id) throw new AfwRuntimeException("loadByMainIndex : country_id is mandatory field");
                if (!$idn_type_id) throw new AfwRuntimeException("loadByMainIndex : idn_type_id is mandatory field");
                if (!$idn) throw new AfwRuntimeException("loadByMainIndex : idn is mandatory field");


                $obj = new WorkflowApplicant();
                $obj->select("idn", $idn);

                if ($obj->load()) {
                        if ($create_obj_if_not_found) $obj->activate();
                        return $obj;
                } elseif ($create_obj_if_not_found) {
                        $obj->set("idn", $idn);
                        $obj->set("idn_type_id", $idn_type_id);
                        $obj->set("country_id", $country_id);
                        //$obj->set("xxid", $idn);
                        $obj->insertNew();
                        if (!$obj->id) return null; // means beforeInsert rejected insert operation
                        $obj->is_new = true;
                        return $obj;
                } else return null;
        }

        public function getMissedDocument($lang)
        {
                $aqObj = ApplicantQualification::getMyQualificationNeedingFileAttachment($this->id);
                if ($aqObj) return [DocType::$DOC_TYPE_DIPLOMA, $aqObj->id, $aqObj->getDisplay($lang)];

                $aeObj = ApplicantEvaluation::getMyEvaluationNeedingFileAttachment($this->id);
                if ($aeObj) return [DocType::$DOC_TYPE_EXAM, $aeObj->id, $aeObj->getDisplay($lang)];

                return [0, 0, ''];
        }

        public function getDisplay($lang = 'ar')
        {
                $return = trim($this->getDefaultDisplay($lang));
                if (!$return) return $this->tm("identity", $lang) . " : " . $this->getVal("idn");
                else return $return;
        }

        public function getWideDisplay($lang = 'ar')
        {
                $return = trim($this->getDefaultDisplay($lang));
                $return .= " " . $this->tm("identity") . " : " . $this->getVal("idn");
                return $return;
        }



        public function stepsAreOrdered()
        {
                return false;
        }



        

        public function beforeMaj($id, $fields_updated)
        {
                //die("beforeMaj fields_updated = ".var_export($fields_updated,true)." id= $id");
                $lang = AfwLanguageHelper::getGlobalLanguage();
                $birth_gdate = $this->getVal("birth_gdate");
                $birth_date = $this->getVal("birth_date");

                if ((!$birth_gdate) and $birth_date) {
                        $birth_gdate = AfwDateHelper::hijriToGreg($birth_date);
                        $this->set("birth_gdate", $birth_gdate);
                }

                if ((!$birth_date) and $birth_gdate) {
                        $birth_date = AfwDateHelper::to_hijri($birth_gdate);
                        $this->set("birth_date", $birth_date);
                }

                $idn = $this->getVal("idn");
                $idn_type_id = $this->getVal("idn_type_id");
                if(!$idn_type_id) list($idn_correct, $idn_type_id) = AfwFormatHelper::getIdnTypeId($idn);
                if ((!$idn) or (!$idn_type_id)) // should never happen but ...
                {
                        throw new  AfwBusinessException("WorkflowApplicant : BAD DATA For IDN=$idn IDN-TYPE=$idn_type_id");
                }

                if (($idn_type_id == 4) and (!trim($this->getVal("passeport_num")))) {
                        $this->set("passeport_num", $idn);
                }
                $first_register = false;
                // throw new AfwRuntimeException("For IDN=$idn beforeMaj($id, fields_updated=".var_export($fields_updated,true).") before set id=".var_export($id,true));

                if (!$id) // the ID of an workflow_applicant is his IDN
                {
                        if ($idn_type_id == 3) $idn_type_id = 2;
                        if (($idn_type_id == 1) or ($idn_type_id == 2)) {
                                if (!is_numeric($idn)) throw new AfwBusinessException("The identity type is not correctly entered",$lang,"","","index.php","IDN $idn of TYPE $idn_type_id SHOULD BE NUMERIC", "workflow"); // 
                                list($idn_correct, $type) = AfwFormatHelper::getIdnTypeId($idn);
                                if ($type != $idn_type_id) throw new AfwBusinessException("The identity type is incorrect",$lang,"","","index.php","IDN $idn is not of type $idn_type_id but of type $type", "workflow"); // 
                                if (!$idn_correct) throw new AfwBusinessException("The identity number is not correctly entered",$lang,"","","index.php","IDN $idn of TYPE $idn_type_id HAVE BAD FORMAT", "workflow"); //  
                                $this->set("id", $idn);
                        } else {
                                $country_id = $this->getVal("country_id");
                                if (!$country_id) throw new  AfwBusinessException("The country/nationalty is required",$lang,"","","index.php","For IDN=$idn IDN-TYPE=$idn_type_id COUNTRY IS REQUIRED", "workflow");
                                $id = IdnToId::convertToID('workflow', $country_id, $idn_type_id, $idn);
                                if (!$id) throw new  AfwBusinessException("Failed IDN conversion IdnToId::convertToID('workflow', $country_id, $idn_type_id, $idn)");
                                $this->set("id", $id);
                        }



                        $id = $this->id;
                        $first_register = true;
                        // throw new AfwRuntimeException("For IDN=$idn beforeMaj($id, fields_updated=".var_export($fields_updated,true).") after set id=".var_export($id,true));
                } elseif (($idn_type_id == 1) or ($idn_type_id == 2) or ($idn_type_id == 3)) {
                        if ($id != $idn) throw new AfwBusinessException("beforeMaj Contact admin please because IDN=$idn != id=$id when idn_type_id == $idn_type_id");
                }

                

                return true;
        }

        public function afterMaj($id, $fields_updated)
        {
                
        }


        


        
        protected function getOtherLinksArray($mode, $genereLog = false, $step = "all")
        {
                $lang = AfwLanguageHelper::getGlobalLanguage();
                // $objme = AfwSession::getUserConnected();
                // $me = ($objme) ? $objme->id : 0;

                $otherLinksArray = $this->getOtherLinksArrayStandard($mode, $genereLog, $step);
                $my_id = $this->getId();
                $idn = $this->getVal("idn");
                $displ = $this->getDisplay($lang);

        
                if ($mode == "mode_applicationList") {
                        $already_plan_ids = $this->getAlreadyPlanIds(2);
                        $aplanList = ApplicationPlan::getCurrentApplicationPlans($already_plan_ids);
                        $color = 'blue';
                        foreach ($aplanList as $aplanItem) {
                                $application_plan_id = $aplanItem->id;
                                $application_model_id = $aplanItem->getVal("application_model_id");
                                unset($link);
                                $link = array();
                                $title = "التقديم على " . $aplanItem->getShortDisplay($lang);
                                // $title_detailed = $title . "لـ : " . $displ;
                                $link["URL"] = "main.php?Main_Page=afw_mode_edit.php&cl=Application&currmod=workflow&sel_applicant_id=$my_id&sel_idn=$idn&sel_application_plan_id=$application_plan_id&sel_application_simulation_id=2&sel_application_model_id=$application_model_id";
                                $link["TITLE"] = $title;
                                $link["COLOR"] = $color;
                                $link["UGROUPS"] = array();
                                $otherLinksArray[] = $link;
                                if ($color == 'yellow') $color = 'blue';
                                elseif ($color == 'green') $color = 'yellow';
                                elseif ($color == 'blue') $color = 'green';
                        }
                }

        
                return $otherLinksArray;
        }


        public function attributeIsApplicable($attribute)
        {

                return true;
        }


        public function idnFormat($field_name, $col_struct)
        {
                if ($field_name == "idn") {
                        return ($this->getVal("idn_type_id") <= 3) ? 'SA-IDN' : 'ALPHA-NUMERIC';
                }
                return '';
        }

        protected function getSpecificDataErrors(
                $lang = 'ar',
                $show_val = true,
                $step = 'all',
                $erroned_attribute = null,
                $stop_on_first_error = false,
                $start_step = null,
                $end_step = null
        ) {
                global $objme;
                $sp_errors = [];
                $birth_gdate_step = $this->stepOfAttribute('birth_gdate');
                $birth_gdate_is_in_step = $this->stepContainAttribute($step, 'birth_gdate');
                $no_step_scope = (!$start_step and !$end_step);
                $step_in_scope = (($birth_gdate_step >= $start_step) and ($birth_gdate_step <= $end_step));
                $birth_gdate_is_in_steps_scope = ($birth_gdate_is_in_step and ($no_step_scope or $step_in_scope));


                if ($birth_gdate_is_in_steps_scope) {
                        $birth_gdate = $this->getVal('birth_gdate');
                        $birth_date = $this->getVal('birth_date');

                        if (!$birth_gdate and !$birth_date) {
                                $sp_errors['birth_gdate'] = $this->translateMessage('birth date gregorian or hijri should be defined');
                                // $sp_errors['birth_gdate'] .= "<pre dir='ltr'> dbg : birth_gdate_is_in_steps_scope = birth_gdate_is_in_step and (no_step_scope or step_in_scope) \n $birth_gdate_is_in_steps_scope = $birth_gdate_is_in_step and ($no_step_scope or $step_in_scope)</pre>";
                        }
                }

                return $sp_errors;
        }



        public function qsearchByTextEnabled()
        {
                return false;
        }

        protected function getPublicMethods()
        {

                $pbms = array();
                /*
                $color = "orange";
                $title_en = "Verify enrollment at another university";
                $title_ar = $this->tm($title_en, 'ar');                
                $methodName = "verifyEnrollment";
                $pbms[AfwStringHelper::hzmEncode($methodName)] = array("METHOD" => $methodName, "COLOR" => $color, 
                                        "LABEL_AR" => $title_ar, 
                                        "LABEL_EN" => $title_en, 
                                        "PUBLIC" => true, "BF-ID" => "", 'STEPS' => 'all');*/
                
                return $pbms;
        }


        protected function afterSetAttribute($attribute)
        {
                if($attribute=="idn") // and (!$this->getVal("idn_type_id"))) 
                {
                        list($idn_correct, $idn_type_id) = AfwFormatHelper::getIdnTypeId($this->getVal("idn"));
                        if($idn_correct)
                        { 
                                $this->set("idn_type_id", $idn_type_id);                                
                        }  
                }

                if($attribute=="idn_type_id") // and (!$this->getVal("idn_type_id"))) 
                {
                        if($this->getVal("idn_type_id")==1)
                        { 
                                $this->set("country_id", 183);                                
                        }  
                }
        }
        

        

        public function canUploadFiles()
        {
                return [true, ""];
        }

        
        public function calcDragDropDiv($what = "value")
        {
                $lang = AfwSession::getSessionVar("current_lang");
                if (!$lang) $lang = "ar";
                $adm_file_types = AfwSession::config("adm_file_types", "0");
                $allowed_upload_size = AfwSession::config("allowed_upload_size", "0");
                $objme = AfwSession::getUserConnected();

                // $practice_employee_id = $this->getVal("employee_id");
                // $connected_employee_id = ($objme) ? $objme->getEmployeeId() : 0;
                // role 341 is admin of bpractice platform
                // $connected_employee_is_admin = ($objme) ? ($objme->isAdmin() or $objme->hasRole("bpractice", 341)) : false;

                $this_id = $this->getId();

                $file_dir_name = dirname(__FILE__);

                list($ext_arr, $ft_arr) = DocType::getExentionsAllowed($adm_file_types);
                $ext_list = implode(", ", $ext_arr);
                $ft_list = implode(", ", $ft_arr);

                $dtList = DocType::loadAll($adm_file_types);

                $module_doc_types = array();

                foreach ($dtList as $dtId => $dtObject) {
                        $module_doc_types[$dtId] = array('name' => $dtObject->getVal("titre_short"), 'mandatory' => "لا", 'desc' => $dtObject->getVal("titre"), 'extentions' => $dtObject->getVal("extentions"));
                }

                //$module_doc_types[7]["mandatory"] = "نعم";
                //$module_doc_types[13]["mandatory"] = "نعم";
                $module_doc_types_header = array('name' => "صنف المستند", 'mandatory' => "إجباري؟", 'desc' => "الوصف", 'extentions' => "أنواع الملفات المسموح بها");

                list($html_doc_types,  $f_ids) = AfwHtmlHelper::tableToHtml($module_doc_types, $module_doc_types_header);
                $details_title = $this->tm("Files upload conditions details", $lang);
                $help_instruction = $this->tm("Click on [Select file] or drag and drop it directly to this area to upload it", $lang);
                $file_select = $this->tm("Select the file", $lang);
                $file_size_condition = $this->tm("Can't upload files if size exceed", $lang);
                $MB = $this->tm("Mega Bytes", $lang);
                list($can, $message_upload_blocked_reason) = $this->canUploadFiles();
                if ($can) {


                        list($doc_type_id, $doc_attach_id, $doc_attach_name) = $this->getMissedDocument($lang);
                        // die("(doc_type_id, doc_attach_id, doc_attach_name) = ($doc_type_id, $doc_attach_id, , $doc_attach_name)")
                        if ($doc_type_id) {
                                $whendone = "submit";
                                $drop_class = "dc-$doc_type_id";
                                $please_mess = $this->tm("Please upload the following document", $lang);
                                $htmlDiv = "<div id='fg-doc_type_id' class='attrib-doc_type_id form-group width_pct_100 '>
  <label for='doc_type_id' class='hzm_label hzm_label_doc_type_id'>$please_mess :</label>
  <input type='hidden' name='doc_type_id' id='doc_type_id' value='$doc_type_id' />
  <input type='hidden' name='doc_attach_id' id='doc_attach_id' value='$doc_attach_id' />
  <div id='div_doc_type_name' class='btn btn-full col-doc_type_id btn-primary'>$doc_attach_name</div>
</div>";
                        } else {
                                $obj = new ApplicantFile();
                                $col = "doc_type_id";
                                $col_structure = $obj->getMyDbStructure('structure', $col);
                                $col_structure["NO-FGROUP"] = true;
                                $openedInGroupDiv = false;
                                list($htmlDiv, $openedInGroupDiv, $fgroup) = AfwEditMotor::attributeEditDiv($obj, $col, $col_structure, "", $lang, $openedInGroupDiv);
                                $whendone = "hide";
                                $drop_class = "hide";
                        }

                        // die("htmlDiv start here :".$htmlDiv);
                        return "
                             </form>
                             <link href='../lib/assets/css/style.css' rel='stylesheet' />
                             <form id='upload' method='post' action='afw_my_upload.php' enctype='multipart/form-data'>
                    $htmlDiv          
        			<div id='drop' whendone='$whendone' class='$drop_class'>
        				$help_instruction
                                        <br>
        				<a>$file_select</a>
                                        <input type='hidden' name='module' value='workflow' />
                                        <input type='hidden' name='afup' value='workflow_applicant' />
                                        <input type='hidden' name='afup_objid' value='$this_id' />
        				                <input type='file' name='upl' multiple />
                                        <br><div class='file_space'><br></div><br>
                                        <div class='ft_h'>$details_title</div>
                                        <div class='ft_table'>$html_doc_types</div>
                                        <div class='fc_size'>$file_size_condition <span>$allowed_upload_size</span> $MB</div>
        			</div>
        
        			<ul>
        				<!-- The file uploads will be shown here -->
        			</ul>
        
        		</form>
                        <!-- JavaScript Includes -->
        		<script src='../lib/assets/js/jquery.knob.js'></script>
        
        		<!-- jQuery File Upload Dependencies -->
        		<script src='../lib/assets/js/jquery.ui.widget.js'></script>
        		<script src='../lib/assets/js/jquery.iframe-transport.js'></script>
        		<script src='../lib/assets/js/jquery.fileupload.js'></script>
        		
        		<!-- Our main JS file -->
        		<script src='../lib/assets/js/script-whs.js'></script>
                        ";
                } else {


                        return "
                             </form>
        			<div id='drop'>
        				<div class='ft_h upload_blocked'>$message_upload_blocked_reason</div>
                        <div class='ft_h'>$details_title</div>
                        <div class='ft_table'>$html_doc_types</div>
                        <div class='fc_size'>$file_size_condition <span>$allowed_upload_size</span> $MB</div>
        			</div>
                        ";
                }
        }

        public function getAvailableDocTypes()
        {
                $doc_type_arr = array();
                // بترتيب الأولوية

                // big_photo - صورة تعريفية كبيرة  
                $pho = null; // $this->getPhoto();
                if (!$pho or $pho->isEmpty()) $doc_type_arr[] = self::$doc_type_big_photo;

                // small_photo - صورة صغيرة
                $sph = null; // $this->getSmall_photo();
                if (!$sph or $sph->isEmpty()) $doc_type_arr[] = self::$doc_type_small_photo;

                /*
        // banner - بنر  
        $bnn = $this->getBanner();
        if(!$bnn or $bnn->isEmpty()) $doc_type_arr[] = self::$doc_type_banner;
        */
                // attachement - مرفق توضيحي
                $doc_type_arr[] = self::$doc_type_attachement;

                return $doc_type_arr;
        }

        

        /**
         * @param WorkflowFile $wf
         */

        public function attach_file($wf, $doc_type_id = 0, $doc_attach_id = 0)
        {

                $afObj = WorkflowApplicantFile::loadByMainIndex($this->getId(), $wf->getId(), $this->getVal("idn"), $create_obj_if_not_found = true);

                if (!$doc_type_id) $doc_type_id = $wf->getVal("doc_type_id");
                $afObj->set("doc_type_id", $doc_type_id);
                $afObj->set("name_ar", $afObj->showAttribute("doc_type_id", null, true, 'ar'));
                $afObj->set("name_en", $afObj->showAttribute("doc_type_id", null, true, 'en'));
                $afObj->set("desc_ar", $afObj->showAttribute("doc_type_id", null, true, 'ar') . " : " . $wf->getVal("afile_name"));
                $afObj->set("desc_en", $afObj->showAttribute("doc_type_id", null, true, 'en') . " : " . $wf->getVal("afile_name"));
                //$afObj->set("afile_ext",$af->getVal("afile_ext"));
                //$objme = AfwSession::getUserConnected();
                // "تم تحميله من طرف ".$objme->getDisplay($lang)." بتاريخ ".date("d/m/Y")
                $afObj->commit();

                $dtObj = $afObj->het("doc_type_id");
                $doc_type_lookup_code = $dtObj->getVal("lookup_code");
                if (!$doc_type_lookup_code) $doc_type_lookup_code = "other";
                $from_name = $wf->getVal("afile_name") . " " . $wf->getVal("original_name") . " " . $wf->getParsedText();
                

                $afile_name = $doc_type_lookup_code . "-" . $afObj->id;

                return $afile_name;
        }

        public function getAttachedFileWithType($type)
        {
                $file_dir_name = dirname(__FILE__);
                $afObj = new WorkflowApplicantFile();
                $afObj->select("workflow_applicant_id", $this->getId());
                $afObj->select("doc_type_id", $type);
                $afObj->select("active", "Y");
                $afObj->load();
                //if($afObj->getId()<=0) die("pfObj($type) = ".var_export($afObj,true));
                return $afObj;
        }
}

