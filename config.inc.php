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

// Database Configuration.
$CFG['db']['enabled'] = true;
$CFG['db']['driver'] = "MySQL"; // NOTE: case-sensitive!
$CFG['db']['host'] = "127.0.0.1";
$CFG['db']['port'] = "1090";
$CFG['db']['database'] = "sf_demo";
$CFG['db']['username'] = "mypix_login"; // In dedication of the infamous MyPictures folder with nudes of him and other gay men.
$CFG['db']['password'] = "py3FFZdRmyqyDmfm";

// Application configuration.
$CFG['app']['name'] = "demo";
$CFG['app']['title'] = "Demo Application";

// Jokes module.
$CFG['app']['jokes']['enabled'] = true;
$CFG['app']['jokes']['smallpenis.custominput'] = "Mojang";
$CFG['app']['jokes']['madbros.custominput'] = "Everybody";
