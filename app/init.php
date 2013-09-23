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

// Modules
include(APP_DIR . "modules/DefaultModule.php");
include(APP_DIR . "modules/jokes/JokesModule.php");

// Main class.
include(APP_DIR . "Application.php");

// Initialize all the things!
$application = function($system) {
	return new DemoApplication($system);
};