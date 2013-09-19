<?php
//begin loading page.
define("SF_INIT", "1");
define("THIS_SCRIPT", "index.php");
define("SEC_LEVEL", "0");
include("admin/system/init.php");

//now run the template script!
$system->scripting->run_script('main.template');

unset($system);
exit;
?>