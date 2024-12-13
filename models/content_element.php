<?php

class ContentElement extends WorkflowObject
{
        public function getTokens($lang)
        {
            throw new AfwRuntimeException("for this class ".get_class($this)." the getTokens is not implemented");
        }


        protected function getPublicMethods()
        {
            
            $pbms = array();
        
            $contentList = Content::getMyOpenedContents();

            foreach ($contentList as $contentId => $contentObj) {
                $methodName0 = "AddMeAsContentItemIn";
                $methodName = $methodName0 . $contentId;
                

                $color = "green";
                $title_ar = "اضافتي الى المحتوى : ".$contentObj->getDisplay("ar"); 
                $title_en = "Add me to content : ".$contentObj->getDisplay("en"); 
                
                $pbms[AfwStringHelper::hzmEncode($methodName)] = array("METHOD"=>$methodName,
                                                                        "COLOR"=>$color, 
                                                                        "LABEL_AR"=>$title_ar, 
                                                                        "LABEL_EN"=>$title_en, 
                                                                        "ADMIN-ONLY"=>true, 
                                                                        "BF-ID"=>"", 'STEP' =>1);
            }
            
            
            return $pbms;
        }

        protected function afwCall($name, $arguments)
        {
            if (substr($name, 0, 20) == "AddMeAsContentItemIn") {
                $content_id = intval(substr($name, 20));
                return $this->AddMeAsContentItemIn($content_id, $arguments[0]);
            }

            return false;
            // the above return false should be keeped it means it is not treated
        }
}