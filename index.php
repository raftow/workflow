<?php
$direct_dir_name = $file_dir_name = dirname(__FILE__);
include("$file_dir_name/workflow_start.php");
$objme = AfwSession::getUserConnected();
$Main_Page = "home.php";
$My_Module = $MODULE;

$options = [];
$options["dashboard-stats"] = true;
$options["chart-js"] = true;
$options["tree-view-js"] = true;
// AfwRunHelper::simpleError("System under maintenance. contactez RB");
AfwMainPage::echoMainPage($My_Module, $Main_Page, $file_dir_name, $options);