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
 * The application directory to load. This is all the application files implementing the framework.
 *
 */
define("APP_DIR", "app/");

/**
 * The application file name.  This is required to initialize the application.  .php in the name is not required.
 *
 */
define("APP_FILE", "DemoApp.php");

/**
 * The system directory to load.  This is all the framework files.
 *
 */
define("SYSTEM_DIR", "system/");

/**
 * The debug mode.  Prints message all over the screen.
 *
 */
define("DEBUG_MODE", "true"); // false for production.