<?php
/**
 * Class config.inc.php
 *
 * @author SuperSpyTX
 */

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

// NOTE: This is a sample configuration, you would obviously change this.

/**
 * The base URI of this install.  You can leave this blank if this is running from the root directory.
 * This is used in the routing class.
 *
 * TODO: Make this process automatic.
 *
 */
define("BASE_URI", "/supahframework/");

/**
 * The application directory to load. This is where all the application files lie.
 *
 */
define("APP_DIR", "app/");

/**
 * The system directory to load.  This is where all the framework files lie.
 */
define("SYSTEM_DIR", "system/");

// Now the main configuration!

$CFG['app']['name'] = "demo";
$CFG['app']['title'] = "Demo Application";
$CFG['app']['jokes']['smallpenis.custominput'] = "Mojang";
$CFG['app']['jokes']['madbros.custominput'] = "Everybody";
