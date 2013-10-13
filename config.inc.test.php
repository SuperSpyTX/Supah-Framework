<?php
/**
 * Class config.inc.php
 *
 * @author SuperSpyTX
 */

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

// This is for my debugging purposes.

/**
 * The base URI of this install.  You can leave this blank if this is running from the root directory.
 * This is used in the routing class.
 */
// TODO: Make this process automatic.
define("BASE_URI", "/supahframework/");

/**
 * The application directory to load. This is where all the application files lie.
 */
define("APP_DIR", "app/");

/**
 * The system directory to load.  This is where all the framework files lie.
 */
define("SYSTEM_DIR", "system/");

// Now the main configuration!

// Database Configuration.
$CFG['db']['enabled'] = false;
$CFG['db']['driver'] = "MySQL"; // NOTE: case-sensitive!
$CFG['db']['host'] = "127.0.0.1";
$CFG['db']['port'] = "3306";
$CFG['db']['database'] = "";
$CFG['db']['username'] = "";
$CFG['db']['password'] = "";

// Application configuration.
$CFG['app']['enabled'] = true;
$CFG['app']['name'] = "demo";
$CFG['app']['title'] = "Demo Application";
$CFG['app']['route.forward'] = true;
$CFG['app']['route.default'] = "default";
$CFG['app']['route.error'] = "error";