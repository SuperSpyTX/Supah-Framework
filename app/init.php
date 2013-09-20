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
include(APP_DIR . "controllers/DefaultController.php");
include(APP_DIR . "routing/DefaultRoute.php");
include(APP_DIR . "routing/RouteTest.php");

// Jokes initializer.  TODO: modules?
include(APP_DIR . "controllers/jokes/JokesController.php");
include(APP_DIR . "routing/jokes/JokesRoute.php");

// Initialize all the things!
$application = function($system) {
	return new DemoApplication($system);
};