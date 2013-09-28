<?php
//begin loading page.
define("SF_INIT", "1");
define("THIS_SCRIPT", "index.php");

// Include configuration file.
include("config.inc.php");

// Include the initializer, which initalizes the Supah Framework environment.
include(SYSTEM_DIR . "init.php");

// Now install those modules :o
if (file_exists(APP_DIR . "modules\jokes\JokesModule.php")) {
	include(APP_DIR . "modules\jokes\JokesModule.php");
	$system->getApplication()->addModule("jokes", new JokesModule($system->getApplication()));
}

$system->exec();
?>