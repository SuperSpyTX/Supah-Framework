<?php
//begin loading page.
define("SF_INIT", "1");
define("THIS_SCRIPT", "index.php");

// Include configuration file.
include("config.inc.php");

// Include the initializer, which initalizes the Supah Framework environment.
include(SYSTEM_DIR . "init.php");

// Now run the framework.
$system->exec();