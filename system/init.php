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
include(SYSTEM_DIR . "System.php");
include(SYSTEM_DIR . "application\IApplication.php");
include(SYSTEM_DIR . "routing\Routing.php");
include(SYSTEM_DIR . "routing\IRoute.php");
include(SYSTEM_DIR . "utilities\StringUtility.php");

// Initialize all the things!
$system = new Supah_Framework\System(APP_DIR . "init.php");