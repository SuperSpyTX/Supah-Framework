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

// Application
include(SYSTEM_DIR . "application/Configuration.php");
include(SYSTEM_DIR . "application/IExecutable.php");
include(SYSTEM_DIR . "application/IApplication.php");
include(SYSTEM_DIR . "application/IController.php");
include(SYSTEM_DIR . "application/IModule.php");

// Database
include(SYSTEM_DIR . "database/IDatabase.php");
include(SYSTEM_DIR . "database/Database.php");

// Routing
include(SYSTEM_DIR . "routing/IRoute.php");
include(SYSTEM_DIR . "routing/Routing.php");

// Templates
include(SYSTEM_DIR . "templates/Page.php");
include(SYSTEM_DIR . "templates/Templates.php");

// Utilities.
include(SYSTEM_DIR . "utilities/GenerationUtility.php");
include(SYSTEM_DIR . "utilities/StringUtility.php");
include(SYSTEM_DIR . "utilities/URIUtility.php");

// Main class.
include(SYSTEM_DIR . "System.php");

// Initialize all the things!
$system = new Supah_Framework\System($_SERVER['REQUEST_URI'], $CFG);