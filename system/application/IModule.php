<?php
/**
 * Class IModule.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework\application;

use Supah_Framework\Configuration;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

/**
 * Class IModule
 * The interface that identifies application modules.
 *
 * @package Supah_Framework\application
 */
interface IModule extends IExecutable {
	/**
	 * Basic constructor.
	 *
	 * @param $application IApplication
	 */
	function __construct($application);

	/**
	 * Gets whether the module is enabled or not.
	 *
	 * @return boolean
	 */
	function isEnabled();

	/**
	 * Gets the name of this module.
	 *
	 * @return string
	 */
	public static function getName();

	/**
	 * Gets the configuration for this module.
	 *
	 * @return Configuration
	 */
	function getConfiguration();

	/**
	 * Gets the application for this module.
	 *
	 * @return IApplication
	 */
	function getApplication();

	/**
	 * Gets the routes for the Routing class.
	 *
	 * @return array
	 */
	function getRoutes();
}