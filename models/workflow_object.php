<?php

class WorkflowObject extends AFWObject{

        public static $content_type_picture = 1;
        public static $content_type_publication = 2;
        public static $content_type_banner = 3;
        public static $content_type_icontent = 4;

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
	

        public function getTimeStampFromRow($row,$context="update", $timestamp_field="")
        {
                if(!$timestamp_field) return $row["synch_timestamp"];
                else return $row[$timestamp_field];
        }


        public static function code_of_content_type_enum($lkp_id=null)
        {
            global $lang;
            if($lkp_id) return self::content_type()['code'][$lkp_id];
            else return self::content_type()['code'];
        }

        public static function name_of_content_type_enum($content_type_enum, $lang="ar")
        {
            return self::content_type()[$lang][$content_type_enum];            
        }
        

        public static function list_of_content_type_enum()
        {
            global $lang;
            return self::content_type()[$lang];
        }
        
        public static function content_type()
        {
                $arr_list_of_content_type = array();
                
                        
                $arr_list_of_content_type["en"][1] = "Picture";
                $arr_list_of_content_type["ar"][1] = "صورة";
                $arr_list_of_content_type["code"][1] = "Picture";

                $arr_list_of_content_type["en"][2] = "Publication";
                $arr_list_of_content_type["ar"][2] = "منشور";
                $arr_list_of_content_type["code"][2] = "Publication";

                
                $arr_list_of_content_type["en"][3] = "Banner";
                $arr_list_of_content_type["ar"][3] = "صورة عرضية";
                $arr_list_of_content_type["code"][3] = "Banner";

                $arr_list_of_content_type["en"][4] = "Intelligent content";
                $arr_list_of_content_type["ar"][4] = "محتوى ذكي";
                $arr_list_of_content_type["code"][4] = "icontent";

                

                
                return $arr_list_of_content_type;
        } 

        public static function list_of_content_category_enum()
        {
            global $lang;
            return self::content_category_enum()[$lang];
        }
        
        public static function content_category_enum()
        {
                $arr_list_of_content_category_enum = array();
                
                        
                $arr_list_of_content_category_enum["en"][1] = "Stats";
                $arr_list_of_content_category_enum["ar"][1] = "الإحصائيات";
                $arr_list_of_content_category_enum["code"][1] = "stats";

                $arr_list_of_content_category_enum["en"][2] = "Business entity description";
                $arr_list_of_content_category_enum["ar"][2] = "وصف كيان أعمال";
                $arr_list_of_content_category_enum["code"][2] = "entity";

                
                
                return $arr_list_of_content_category_enum;
        }

        public static function list_of_application_status_enum()
        {
            global $lang;
            return self::application_status_enum()[$lang];
        }
        
        public static function application_status_enum()
        {
                $arr_list_of_application_status_enum = array();
                
                        
                $arr_list_of_application_status_enum["en"][1] = "application pending";
                $arr_list_of_application_status_enum["ar"][1] = "جاري التقديم";

                $arr_list_of_application_status_enum["en"][2] = "applied";
                $arr_list_of_application_status_enum["ar"][2] = "متقدم";
                
                $arr_list_of_application_status_enum["en"][3] = "withdrawn";
                $arr_list_of_application_status_enum["ar"][3] = "منسحب";

                $arr_list_of_application_status_enum["en"][4] = "excluded";
                $arr_list_of_application_status_enum["ar"][4] = "مستبعد";
                
                return $arr_list_of_application_status_enum;
        }

        public static function list_of_desire_status_enum()
        {
            global $lang;
            return self::desire_status_enum()[$lang];
        }
        
        public static function desire_status_enum()
        {
                $arr_list_of_application_status_enum = array();
                
                        
                $arr_list_of_desire_status_enum["en"][1] = "candidat";
                $arr_list_of_desire_status_enum["ar"][1] = "مترشح";

                $arr_list_of_desire_status_enum["en"][2] = "excluded";
                $arr_list_of_desire_status_enum["ar"][2] = "مستبعد";

                $arr_list_of_desire_status_enum["en"][3] = "initial acceptance";
                $arr_list_of_desire_status_enum["ar"][3] = "قبول مبدئي";
                
                $arr_list_of_desire_status_enum["en"][4] = "final acceptance";
                $arr_list_of_desire_status_enum["ar"][4] = "قبول نهائي";

                $arr_list_of_desire_status_enum["en"][5] = "withdrawn";
                $arr_list_of_desire_status_enum["ar"][5] = "منسحب";

                
                return $arr_list_of_desire_status_enum;
        }
        
        public static function list_of_application_admission_enum()
        {
            global $lang;
            return self::application_admission_enum()[$lang];
        }
        
        public static function application_admission_enum()
        {
                $arr_list_of_application_admission_enum = array();
                
                        
                $arr_list_of_application_admission_enum["en"][1] = "Application";
                $arr_list_of_application_admission_enum["ar"][1] = "تقديم";
                $arr_list_of_application_admission_enum["code"][1] = "APP";

                $arr_list_of_application_admission_enum["en"][2] = "Workflowission";
                $arr_list_of_application_admission_enum["ar"][2] = "قبول";
                $arr_list_of_application_admission_enum["code"][2] = "ADM";

                
                return $arr_list_of_application_admission_enum;
        }

        
        public static function list_of_agreement_scope_type_enum()
        {
            global $lang;
            return self::agreement_scope_type_enum()[$lang];
        }
        
        public static function agreement_scope_type_enum()
        {
                $arr_list_of_agreement_scope_type_enum = array();
                
                        
                $arr_list_of_agreement_scope_type_enum["en"][1] = "general";
                $arr_list_of_agreement_scope_type_enum["ar"][1] = "عام";
                
                $arr_list_of_agreement_scope_type_enum["en"][2] = "private";
                $arr_list_of_agreement_scope_type_enum["ar"][2] = "خاص";
                
                
                
                return $arr_list_of_agreement_scope_type_enum;
        }

        public static function list_of_marital_status_enum()
        {
            global $lang;
            return self::marital_status_enum()[$lang];
        }
        
        public static function marital_status_enum()
        {
                $arr_list_of_marital_status_enum = array();
                
                        
                $arr_list_of_marital_status_enum["en"][1] = "Single";
                $arr_list_of_marital_status_enum["ar"][1] = "أعزب - عزباء";
                $arr_list_of_marital_status_enum["code"][1] = "Single";

                $arr_list_of_marital_status_enum["en"][2] = "Married";
                $arr_list_of_marital_status_enum["ar"][2] = "متزوج(ة)";
                $arr_list_of_marital_status_enum["code"][2] = "Married";

                
                $arr_list_of_marital_status_enum["en"][3] = "Widow";
                $arr_list_of_marital_status_enum["ar"][3] = "أرملة";
                $arr_list_of_marital_status_enum["code"][3] = "Widow";
                
                $arr_list_of_marital_status_enum["en"][4] = "Divorced";
                $arr_list_of_marital_status_enum["ar"][4] = "مطلقة";
                $arr_list_of_marital_status_enum["code"][4] = "Divorced";

                
                return $arr_list_of_marital_status_enum;
        }

        public static function list_of_address_type_enum()
        {
            global $lang;
            return self::address_type_enum()[$lang];
        }
        
        public static function address_type_enum()
        {
                $arr_list_of_address_type_enum = array();
                
                $arr_list_of_address_type_enum["en"][1] = "National Address";
                $arr_list_of_address_type_enum["ar"][1] = "العنوان الوطني";
                $arr_list_of_address_type_enum["code"][1] = "NA";
                        
                $arr_list_of_address_type_enum["en"][2] = "Parent Address";
                $arr_list_of_address_type_enum["ar"][2] = "ولي الامر";
                $arr_list_of_address_type_enum["code"][2] = "PA";

                $arr_list_of_address_type_enum["en"][3] = "Work Address";
                $arr_list_of_address_type_enum["ar"][3] = "عنوان العمل";
                $arr_list_of_address_type_enum["code"][3] = "BU";

                
                $arr_list_of_address_type_enum["en"][4] = "Permanent Address";
                $arr_list_of_address_type_enum["ar"][4] = "دائمة";
                $arr_list_of_address_type_enum["code"][4] = "PR";

                $arr_list_of_address_type_enum["en"][4] = "Billing Address";
                $arr_list_of_address_type_enum["ar"][4] = "اصدار الفواتير";
                $arr_list_of_address_type_enum["code"][4] = "BI";

                
                return $arr_list_of_address_type_enum;
        }

        public static function list_of_employer_enum()
        {
            global $lang;
            return self::employer_enum()[$lang];
        }
        
        public static function employer_enum()
        {
                $arr_list_of_employer_enum = array();
                
                $arr_list_of_employer_enum["en"][1] = "Government sector";
                $arr_list_of_employer_enum["ar"][1] = "قطاع حكومي";
                $arr_list_of_employer_enum["code"][1] = "Government";
                        
                $arr_list_of_employer_enum["en"][2] = "Private sector";
                $arr_list_of_employer_enum["ar"][2] = "قطاع خاص";
                $arr_list_of_employer_enum["code"][2] = "Private";

                return $arr_list_of_employer_enum;
        }

        public static function list_of_relationship_enum()
        {
            global $lang;
            return self::relationship_enum()[$lang];
        }
        
        public static function relationship_enum()
        {
                $arr_list_of_relationship_enum = array();
                
                $arr_list_of_relationship_enum["en"][1] = "Parent";
                $arr_list_of_relationship_enum["ar"][1] = "والد(ة)";
                $arr_list_of_relationship_enum["code"][1] = "P";
                        
                $arr_list_of_relationship_enum["en"][2] = "Hasband/wife";
                $arr_list_of_relationship_enum["ar"][2] = "زوج(ة)";
                $arr_list_of_relationship_enum["code"][2] = "H";

                $arr_list_of_relationship_enum["en"][3] = "Friend";
                $arr_list_of_relationship_enum["ar"][3] = "صديق";
                $arr_list_of_relationship_enum["code"][3] = "F";

                
                $arr_list_of_relationship_enum["en"][4] = "Son";
                $arr_list_of_relationship_enum["ar"][4] = "الابن";
                $arr_list_of_relationship_enum["code"][4] = "S";

                $arr_list_of_relationship_enum["en"][5] = "Brother/Sister";
                $arr_list_of_relationship_enum["ar"][5] = "الاخ-ت";
                $arr_list_of_relationship_enum["code"][5] = "B";

                $arr_list_of_relationship_enum["en"][6] = "Grandpa";
                $arr_list_of_relationship_enum["ar"][6] = "الجد";
                $arr_list_of_relationship_enum["code"][6] = "G";

                $arr_list_of_relationship_enum["en"][7] = "Neighbor";
                $arr_list_of_relationship_enum["ar"][7] = "الجار";
                $arr_list_of_relationship_enum["code"][7] = "N";

                $arr_list_of_relationship_enum["en"][8] = "Guardian";
                $arr_list_of_relationship_enum["ar"][8] = "ولي الامر";
                $arr_list_of_relationship_enum["code"][8] = "G";

                
                return $arr_list_of_relationship_enum;
        }



        public static function code_of_language_enum($lkp_id=null)
        {
            global $lang;
            if($lkp_id) return self::language()['code'][$lkp_id];
            else return self::language()['code'];
        }

        

        
        
        
        public static function list_of_language_enum()
        {
            global $lang;
            return self::language()[$lang];
        }
        
        public static function language()
        {
                $arr_list_of_language = array();
                
                
                $arr_list_of_language["en"][1] = "Arabic";
                $arr_list_of_language["ar"][1] = "العربية";
                $arr_list_of_language["code"][1] = "ar";

                $arr_list_of_language["en"][2] = "English";
                $arr_list_of_language["ar"][2] = "الإنجليزية";
                $arr_list_of_language["code"][2] = "en";

                
                
                
                return $arr_list_of_language;
        } 


        

        
        public static function list_of_level_enum()
        {
            global $lang;
            return self::level()[$lang];
        }
        
        public static function level()
        {
                $arr_list_of_level = array();

                $main_company = AfwSession::config("main_company","all");
                $file_dir_name = dirname(__FILE__);        
                include($file_dir_name."/../extra/qualification_level-$main_company.php");

                foreach($lookup as $id => $lookup_row)
                {
                    $arr_list_of_level["ar"][$id] = $lookup_row["ar"];
                    $arr_list_of_level["en"][$id] = $lookup_row["en"];
                }

                
                return $arr_list_of_level;
        }


        public static function list_of_job_status_enum()
        {
            global $lang;
            return self::job_status()[$lang];
        }
        
        public static function job_status()
        {
                $arr_list_of_job_status = array();
                
                
                $arr_list_of_job_status["en"][1] = "Employee";
                $arr_list_of_job_status["ar"][1] = "موظف";
                $arr_list_of_job_status["code"][1] = "E";

                $arr_list_of_job_status["en"][2] = "Not Employee";
                $arr_list_of_job_status["ar"][2] = "غير موظف";
                $arr_list_of_job_status["code"][2] = "N";

                
                return $arr_list_of_job_status;
        }


        public static function list_of_genre_enum()
        {
            global $lang;
            return self::genre()[$lang];
        }
        
        public static function genre()
        {
                $arr_list_of_gender = array();
                
                
                $arr_list_of_gender["en"][1] = "Male";
                $arr_list_of_gender["ar"][1] = "بنين";
                $arr_list_of_gender["code"][1] = "M";

                $arr_list_of_gender["en"][2] = "Female";
                $arr_list_of_gender["ar"][2] = "بنات";
                $arr_list_of_gender["code"][2] = "F";

                
                return $arr_list_of_gender;
        }


        public static function list_of_gender_enum()
        {
            global $lang;
            return self::gender()[$lang];
        }
        
        public static function gender()
        {
                $arr_list_of_gender = array();
                
                
                $arr_list_of_gender["en"][1] = "Male";
                $arr_list_of_gender["ar"][1] = "بنين";
                $arr_list_of_gender["code"][1] = "M";

                $arr_list_of_gender["en"][2] = "Female";
                $arr_list_of_gender["ar"][2] = "بنات";
                $arr_list_of_gender["code"][2] = "F";

                $arr_list_of_gender["en"][4] = "Mixed";
                $arr_list_of_gender["ar"][4] = "بنين وبنات";
                $arr_list_of_gender["code"][4] = "X";

                
                
                
                return $arr_list_of_gender;
        }

        public static function list_of_genders_enum()
        {
            global $lang;
            return self::genders()[$lang];
        }
        
        public static function genders()
        {
                $arr_list_of_genders = array();
                
                
                $arr_list_of_genders["en"][1] = "Male";
                $arr_list_of_genders["ar"][1] = "البنين";
                $arr_list_of_genders["code"][1] = "M";

                $arr_list_of_genders["en"][2] = "Female";
                $arr_list_of_genders["ar"][2] = "البنات";
                $arr_list_of_genders["code"][2] = "F";

                $arr_list_of_genders["en"][3] = "Male & Female";
                $arr_list_of_genders["ar"][3] = "البنين و البنات";
                $arr_list_of_genders["code"][3] = "MF";

                
                
                
                return $arr_list_of_genders;
        }


        public static function list_of_training_mode_enum()
        {
            global $lang;
            return self::training_mode()[$lang];
        }
        
        public static function training_mode()
        {
                $arr_list_of_training_mode = array();
                
                
                $arr_list_of_training_mode["en"][1] = "Presence";
                $arr_list_of_training_mode["ar"][1] = "حضوري";
                $arr_list_of_training_mode["code"][1] = "P";

                $arr_list_of_training_mode["en"][2] = "Online";
                $arr_list_of_training_mode["ar"][2] = "عن بعد";
                $arr_list_of_training_mode["code"][2] = "O";

                $arr_list_of_training_mode["en"][3] = "Mixed";
                $arr_list_of_training_mode["ar"][3] = "مدمج";
                $arr_list_of_training_mode["code"][3] = "X";

                
                return $arr_list_of_training_mode;
        }

        public static function list_of_lor_status_enum()
        {
            global $lang;
            return self::lor_status()[$lang];
        }
        
        public static function lor_status()
        {
                $arr_list_of_training_mode = array();
                
                
                $arr_list_of_training_mode["en"][1] = "For review";
                $arr_list_of_training_mode["ar"][1] = "للمراجعة";
                
                $arr_list_of_training_mode["en"][2] = "Rejected";
                $arr_list_of_training_mode["ar"][2] = "مرفوضة";
                
                $arr_list_of_training_mode["en"][3] = "Approved";
                $arr_list_of_training_mode["ar"][3] = "معتمدة";
                
                $arr_list_of_training_mode["en"][4] = "Under review";
                $arr_list_of_training_mode["ar"][4] = "قيد المراجعة";
                
                return $arr_list_of_training_mode;
        }

        
        public static function list_of_notification_type_enum()
        {
            global $lang;
            return self::notification_type()[$lang];
        }
        
        public static function notification_type()
        {
                $arr_list_of_training_mode = array();
                
                
                $arr_list_of_training_mode["en"][1] = "email";
                $arr_list_of_training_mode["ar"][1] = "بريد الكتروني";
                
                $arr_list_of_training_mode["en"][2] = "sms";
                $arr_list_of_training_mode["ar"][2] = "رسالة نصية";
                
                $arr_list_of_training_mode["en"][3] = "phone call";
                $arr_list_of_training_mode["ar"][3] = "اتصال هاتفي";
                
                $arr_list_of_training_mode["en"][4] = "direct contact";
                $arr_list_of_training_mode["ar"][4] = "اتصال مباشر";
                
                return $arr_list_of_training_mode;
        }

        public static function code_of_term_mode_enum($lkp_id=null)
        {
            global $lang;
            if($lkp_id) return self::term_mode()['code'][$lkp_id];
            else return self::term_mode()['code'];
        }
        
        
        public static function list_of_term_mode_enum()
        {
            global $lang;
            return self::term_mode()[$lang];
        }
        
        public static function term_mode()
        {
                $arr_list_of_term_mode = array();
                
                $arr_list_of_term_mode["en"]  [1] = "Annual";
                $arr_list_of_term_mode["ar"]  [1] = "سنوي";
                $arr_list_of_term_mode["code"][1] = "";

                $arr_list_of_term_mode["en"]  [2] = "Semester";
                $arr_list_of_term_mode["ar"]  [2] = "نصفي";
                $arr_list_of_term_mode["code"][2] = "";

                $arr_list_of_term_mode["en"]  [3] = "Trimester";
                $arr_list_of_term_mode["ar"]  [3] = "ثلثي";
                $arr_list_of_term_mode["code"][3] = "";

                $arr_list_of_term_mode["en"]  [4] = "Quarter";
                $arr_list_of_term_mode["ar"]  [4] = "ربعي";
                $arr_list_of_term_mode["code"][4] = "";

                
                
                
                return $arr_list_of_term_mode;
        } 

        public static function list_of_afield_set_enum()
        {
            global $lang;
            return self::afield_set()[$lang];
        }
        
        public static function afield_set()
        {
                $arr_list_of_afield_set = array();
                
                $arr_list_of_afield_set["en"]  [1] = "";
                $arr_list_of_afield_set["ar"]  [1] = "نتائج الإختبارت";
                $arr_list_of_afield_set["code"][1] = "1";

                $arr_list_of_afield_set["en"]  [2] = "";
                $arr_list_of_afield_set["ar"]  [2] = "الحصول على الشهادات العلمية";
                $arr_list_of_afield_set["code"][2] = "2";

                $arr_list_of_afield_set["en"]  [3] = "";
                $arr_list_of_afield_set["ar"]  [3] = "معدلات الشهادات العلمية";
                $arr_list_of_afield_set["code"][3] = "3";

                $arr_list_of_afield_set["en"]  [4] = "";
                $arr_list_of_afield_set["ar"]  [4] = "تواريخ الشهادات العلمية";
                $arr_list_of_afield_set["code"][4] = "4";
                
                $arr_list_of_afield_set["en"]  [5] = "";
                $arr_list_of_afield_set["ar"]  [5] = "درجات في اختبار أو مؤهل علمي";
                $arr_list_of_afield_set["code"][5] = "5";
                
                
                
                return $arr_list_of_afield_set;
        } 
        public static function list_of_afield_type_enum()
        {
            global $lang;
            return self::afield_type()[$lang];
        }
        public static function afield_type()
        {
                $arr_list_of_afield_type = array();

                
                // DATE -  هجري تاريخ  
                // AFIELD_TYPE_DATE = 2; 
                $arr_list_of_afield_type["en"]  [2] = "Date hijri";
                $arr_list_of_afield_type["ar"]  [2] = "تاريخ هجري";
                $arr_list_of_afield_type["code"][2] = "date";
                

                // AMNT - مبلغ من المال  
                // AFIELD_TYPE_AMNT = 3; 
                $arr_list_of_afield_type["en"]  [3] = "Amount";
                $arr_list_of_afield_type["ar"]  [3] = "مبلغ من المال";
                $arr_list_of_afield_type["code"][3] = "amnt";
                $arr_list_of_afield_type["numeric"][3] = true;

                

                // SMALLINT - قيمة عددية صغيرة  
                // AFIELD_TYPE_SMALLINT = 13; 
                $arr_list_of_afield_type["en"]  [13] = "Small Numeric Value";
                $arr_list_of_afield_type["ar"]  [13] = "قيمة عددية صغيرة";
                $arr_list_of_afield_type["code"][13] = "smallnmbr";
                $arr_list_of_afield_type["numeric"][13] = true;

                // BIGINT - قيمة عددية كبيرة  
                // AFIELD_TYPE_BIGINT = 14; 
                $arr_list_of_afield_type["en"]  [14] = "Big Numeric Value";
                $arr_list_of_afield_type["ar"]  [14] = "قيمة عددية كبيرة";
                $arr_list_of_afield_type["code"][14] = "bignmbr";
                $arr_list_of_afield_type["numeric"][14] = true;

                // NMBR - قيمة عددية متوسطة  
                // AFIELD_TYPE_NMBR = 1; 
                $arr_list_of_afield_type["en"]  [1] = "Medium Numeric Value";
                $arr_list_of_afield_type["ar"]  [1] = "قيمة عددية متوسطة";
                $arr_list_of_afield_type["code"][1] = "nmbr";
                $arr_list_of_afield_type["numeric"][1] = true;


                // LIST - اختيار من قائمة  
                // AFIELD_TYPE_LIST = 5; 
                $arr_list_of_afield_type["en"]  [5] = "Choose from list";
                $arr_list_of_afield_type["ar"]  [5] = "اختيار من قائمة";
                $arr_list_of_afield_type["code"][5] = "list";

                // MFK - اختيار متعدد من قائمة  
                // AFIELD_TYPE_MLST = 6;                 
                $arr_list_of_afield_type["en"]  [6] = "multiple choice from list";
                $arr_list_of_afield_type["ar"]  [6] = "اختيار متعدد من قائمة";
                $arr_list_of_afield_type["code"][6] = "mfk";
                
                // PCTG - نسبة مائوية  
                // AFIELD_TYPE_PCTG = 7; 
                $arr_list_of_afield_type["en"]  [7] = "Percentage";
                $arr_list_of_afield_type["ar"]  [7] = "نسبة مائوية";
                $arr_list_of_afield_type["code"][7] = "pctg";
                $arr_list_of_afield_type["numeric"][7] = true;

                // GDAT - تاريخ نصراني  
                // AFIELD_TYPE_GDAT = 9; 
                $arr_list_of_afield_type["en"]  [9] = "G. Date";
                $arr_list_of_afield_type["ar"]  [9] = "تاريخ ميلادي";
                $arr_list_of_afield_type["code"][9] = "Gdat";

                // YN - نعم/لا  
                // AFIELD_TYPE_YN = 8;
                $arr_list_of_afield_type["en"]  [8] = "Yes/No";
                $arr_list_of_afield_type["ar"]  [8] = "نعم/لا";
                $arr_list_of_afield_type["code"][8] = "yn";

                // ENUM - إختيار من قائمة قصيرة  
                // AFIELD_TYPE_ENUM = 12; 
                $arr_list_of_afield_type["en"]  [12] = "Short list - one choice";
                $arr_list_of_afield_type["ar"]  [12] = "إختيار من قائمة قصيرة";
                $arr_list_of_afield_type["code"][12] = "enum";

                // MENUM - إختيار متعدد من قائمة قصيرة  
                // AFIELD_TYPE_MENUM = 15; 
                $arr_list_of_afield_type["en"]  [15] = "Short list - multiple choice";
                $arr_list_of_afield_type["ar"]  [15] = "إختيار متعدد من قائمة قصيرة";
                $arr_list_of_afield_type["code"][15] = "menum";

                // FLOAT - قيمة عددية كسرية  
                // AFIELD_TYPE_FLOAT = 16;
                $arr_list_of_afield_type["en"]  [16] = "float value";
                $arr_list_of_afield_type["ar"]  [16] = "قيمة عددية كسرية";
                $arr_list_of_afield_type["code"][16] = "float";
                $arr_list_of_afield_type["numeric"][16] = true;

                // 	10	نص قصير
                // $afield_type_text = 10;
                $arr_list_of_afield_type["en"]  [10] = "short text";
                $arr_list_of_afield_type["ar"]  [10] = "نص قصير";
                $arr_list_of_afield_type["code"][10] = "text";

                return $arr_list_of_afield_type;
        } 

        public static function list_of_entry_type_enum()
        {
            global $lang;
            return self::entry_type()[$lang];
        }
        
        public static function entry_type()
        {
                $arr_list_of_entry_type = array();
                
                $arr_list_of_entry_type["en"]  [1] = "Manual";
                $arr_list_of_entry_type["ar"]  [1] = "يدويا";
                $arr_list_of_entry_type["code"][1] = "";

                $arr_list_of_entry_type["en"]  [2] = "API";
                $arr_list_of_entry_type["ar"]  [2] = "واجهة برمجة التطبيقات";
                $arr_list_of_entry_type["code"][2] = "";

                $arr_list_of_entry_type["en"]  [3] = "Semi-Automatic";
                $arr_list_of_entry_type["ar"]  [3] = "آلي/يدوي";
                $arr_list_of_entry_type["code"][3] = "";

                $arr_list_of_entry_type["en"]  [4] = "Computed";
                $arr_list_of_entry_type["ar"]  [4] = "محسوب غير مدخل";
                $arr_list_of_entry_type["code"][4] = "";
                
                $arr_list_of_entry_type["en"]  [5] = "Web service";
                $arr_list_of_entry_type["ar"]  [5] = "خدمة واب";
                $arr_list_of_entry_type["code"][5] = "";
                
                
                
                return $arr_list_of_entry_type;
        } 
        
        public static function list_of_payment_status_enum()
        {
            global $lang;
            return self::payment_status()[$lang];
        }
        
        public static function payment_status()
        {
                $arr_list_of_Payment_Status = array();
                
                $arr_list_of_Payment_Status["en"]  [1] = "Not Paid";
                $arr_list_of_Payment_Status["ar"]  [1] = "غير مدفوع";
                $arr_list_of_Payment_Status["code"][1] = "";

                $arr_list_of_Payment_Status["en"]  [2] = "Totally Paid";
                $arr_list_of_Payment_Status["ar"]  [2] = "تم الدفع كليا";
                $arr_list_of_Payment_Status["code"][2] = "";

                $arr_list_of_Payment_Status["en"]  [3] = "Partially Paid";
                $arr_list_of_Payment_Status["ar"]  [3] = "تم الدفع جزئيا";
                $arr_list_of_Payment_Status["code"][3] = "";

                $arr_list_of_Payment_Status["en"]  [4] = "Exempt from payment";
                $arr_list_of_Payment_Status["ar"]  [4] = "معفي من الدفع";
                $arr_list_of_Payment_Status["code"][4] = "";
                
                
                
                
                return $arr_list_of_Payment_Status;
        }
        public static function list_of_payment_method_enum()
        {
            global $lang;
            return self::payment_method()[$lang];
        }
        
        public static function payment_method()
        {
                $arr_list_of_payment_method = array();
                
                $arr_list_of_payment_method["en"]  [1] = "Electronic payment";
                $arr_list_of_payment_method["ar"]  [1] = "دفع الكتروني";
                $arr_list_of_payment_method["code"][1] = "";

                $arr_list_of_payment_method["en"]  [2] = "Sadadd";
                $arr_list_of_payment_method["ar"]  [2] = "سداد";
                $arr_list_of_payment_method["code"][2] = "";

                $arr_list_of_payment_method["en"]  [3] = "Cash";
                $arr_list_of_payment_method["ar"]  [3] = "نقدا";
                $arr_list_of_payment_method["code"][3] = "";
                
                
                
                
                return $arr_list_of_payment_method;
        }
        public static function executeIndicator($object, $indicator, $normal_class, $arrObjectsRelated, $sens="asc", $default_red_pct=0, $default_orange_pct=0)
        {
                global $MODE_SQL_PROCESS_LOURD, $nb_queries_executed;
                $old_nb_queries_executed = $nb_queries_executed;
                $old_MODE_SQL_PROCESS_LOURD = $MODE_SQL_PROCESS_LOURD;
                $MODE_SQL_PROCESS_LOURD = true;

                if(!$normal_class) $normal_class="vert";
                $methodIndicator = "get".$indicator."Indicator";
                list($objective, $value) = $object->$methodIndicator($arrObjectsRelated);

                $objective_red_pct = $object->getVal(strtolower($indicator)."_red_pct");
                if(!$objective_red_pct) $objective_red_pct = $default_red_pct;
                if(!$objective_red_pct) $objective_red_pct = ($sens=="asc") ? 80.0 : 120.0;
                
                $objective_red = $objective_red_pct * $objective / 100.0;
                
                $orange_pct = $object->getVal("orange_pct");
                
                if(!$orange_pct) $orange_pct = $default_orange_pct;
                if(!$orange_pct) $orange_pct = ($sens=="asc") ? 90.0 : 110.0; // %
                $objective_orange_pct = round($objective_red_pct * 100.0 / $orange_pct);
                $objective_orange = $objective_orange_pct * $objective / 100.0;

                if(($sens=="asc"))
                {
                        if($value<$objective_red) $value_class = "$indicator rouge";
                        elseif($value<$objective_orange) $value_class = "orange";
                        else $value_class = $normal_class;
                }
                else
                {
                        if($value>$objective_red) $value_class = "$indicator rouge";
                        elseif($value>$objective_orange) $value_class = "orange";
                        else $value_class = $normal_class;
                }

                $MODE_SQL_PROCESS_LOURD = $old_MODE_SQL_PROCESS_LOURD;
                $nb_queries_executed = $old_nb_queries_executed;
                

                // die("$objective, $value, $value_class, $objective_red, $objective_orange");
                return [$objective, $value, $value_class, $objective_red, $objective_orange];

        }

        public static function list_of_application_table_id()
        {
            global $lang;
            return self::application_table()[$lang];
        }
        
        public static function application_table()
        {
                $arr_list_of_application_table = array();

                $arr_list_of_application_table["ar"][1] = "المتقدمون";
                $arr_list_of_application_table["en"][1] = "Applicants";
                $arr_list_of_application_table["code"][1] = "applicant";

                $arr_list_of_application_table["ar"][2] = "رغبات المتقدم";
                $arr_list_of_application_table["en"][2] = "Applicant desires";
                $arr_list_of_application_table["code"][2] = "adesire";

                $arr_list_of_application_table["ar"][3] = "طلبات التقديم";
                $arr_list_of_application_table["en"][3] = "Applications";
                $arr_list_of_application_table["code"][3] = "application";



                return $arr_list_of_application_table;
        }


        public static function list_of_answer_table_id()
        {
            global $lang;
            return self::answer_table()[$lang];
        }
        

        public static function answer_table_code($ansTabId)        
        {
            return self::answer_table()["code"][$ansTabId];
        }

        public static function answer_table_module($ansTabId)        
        {
            return self::answer_table()["module"][$ansTabId];
        }
        
        public static function answer_table()
        {
                $arr_list_of_answer_table = array();

                $arr_list_of_answer_table["ar"][1] = "أنواع الهويات";
                $arr_list_of_answer_table["en"][1] = "identity type";
                $arr_list_of_answer_table["code"][1] = "identity_type";
                $arr_list_of_answer_table["module"][1] = "workflow";
                
                /*
                $arr_list_of_answer_table["ar"][2] = "xxxx";
                $arr_list_of_answer_table["en"][2] = "xxxx xxxx";
                $arr_list_of_answer_table["code"][2] = "xxxx";*/


                return $arr_list_of_answer_table;
        }


        public function calcHijri_current()
        {
            return AfwDateHelper::currentHijriDate();
        } 


        public static function needUpdateIcon($help)
        {
            return "<img data-toggle='tooltip' data-placement='top' title='$help' width='32' height='32' src=\"pic/need-update.png\" alt=\"\" title=\"\">";
        }

        public static function updatedIcon($help)
        {
            return "<img data-toggle='tooltip' data-placement='top' title='$help' width='32' height='32' src=\"pic/updated.png\" alt=\"\" title=\"\">";
        }

        public function getCssClassName()
        {
            return $this->getTableName();
        }

}