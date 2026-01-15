<?php
$direct_dir_name = $file_dir_name = dirname(__FILE__);
include("$file_dir_name/workflow_start.php");
$objme = AfwSession::getUserConnected();
if($objme)
{

        $objme_has_admission_responsibility = 
        (($objme->hasRole("workflow", WorkflowObject::$AROLE_OF_ADMISSION_RESPONSIBILITY)) or 
         ($objme->hasRole("workflow", WorkflowObject::$AROLE_OF_ADMISSION_MANAGER))
        );


        if($objme->isSuperAdmin())
        {
                $Main_Page = "home.php";
                $My_Module = $MODULE;

                $options = [];
                $options["dashboard-stats"] = true;
                $options["chart-js"] = true;
                $options["tree-view-js"] = true;
                // AfwRunHelper::simpleError("System under maintenance. contactez RB");
                AfwMainPage::echoMainPage($My_Module, $Main_Page, $file_dir_name, $options);
        }
        elseif($objme_has_admission_responsibility)
        {
                $file_dir_name = dirname(__FILE__);
                $Main_Page = "inbox.php";
                $MODULE = $My_Module = "workflow";
                AfwMainPage::echoMainPage($My_Module, $Main_Page, $file_dir_name);
        }

    
}
else
{
    include("$file_dir_name/../workflow/login.php");
}