<?php
ini_set("display_errors",1);
require_once("code/class.ioc.php");
$ioc=new ioc("config.ini");
$ioc->core->processRequest();
?>