<?php
/**
 * Class init.php
 * 
 * @author SuperSpyTX
 */

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

// Include all the things!
include(APP_DIR . str_replace(".php", "", APP_FILE).".php");
include(APP_DIR . "modules/DefaultModule.php");
include(APP_DIR . "modules/JokesModule.php");

// Initialize all the things!
$application = function($system) {
	return new DemoApplication($system);
};