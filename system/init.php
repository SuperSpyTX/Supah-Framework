<?php
/**
 * Class init.php
 *
 * @author SuperSpyTX
 */

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

// TODO: create an dynamic autoloader.

// Include all the things!
include(SYSTEM_DIR . "application\Configuration.php");
include(SYSTEM_DIR . "application\IExecutable.php");
include(SYSTEM_DIR . "application\IApplication.php");
include(SYSTEM_DIR . "application\IController.php");
include(SYSTEM_DIR . "application\IModule.php");
include(SYSTEM_DIR . "routing\Routing.php");
include(SYSTEM_DIR . "routing\IRoute.php");
include(SYSTEM_DIR . "templates\Page.php");
include(SYSTEM_DIR . "templates\Templates.php");
include(SYSTEM_DIR . "utilities\GenerationUtility.php");
include(SYSTEM_DIR . "utilities\StringUtility.php");
include(SYSTEM_DIR . "utilities\URIUtility.php");

include(SYSTEM_DIR . "System.php");

// Initialize all the things!
$system = new Supah_Framework\System(APP_DIR . "init.php", $_SERVER['REQUEST_URI'], $CFG);