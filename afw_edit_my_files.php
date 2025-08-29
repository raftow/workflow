<?php
     $file_dir_name = dirname(__FILE__);
     include_once ("$file_dir_name/ini.php");
     include_once ("$file_dir_name/module_config.php");

     require_once ("$file_dir_name/../lib/afw/afw_autoloader.php");
     AfwSession::startSession();
     $objme = AfwSession::getUserConnected();
     $me = "u".$objme->id;
     $codeme = substr(md5("code".$me),0,8);

     include("$file_dir_name/../lib/afw/afw_edit_my_files.php?y=$codeme");
?>
