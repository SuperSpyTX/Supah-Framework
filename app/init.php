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
include(APP_DIR . APP_FILE);
include(APP_DIR . "routing/default.php");
include(APP_DIR . "routing/routetest.php");

// Initialize all the things!
$application = function($system) {
	return new DemoApp($system);
};