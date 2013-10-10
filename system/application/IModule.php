<?php
/**
 * Class IModule.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework\application;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

interface IModule extends \Supah_Framework\application\IExecutable {
	/**
	 * Basic constructor.
	 *
	 * @param $application \Supah_Framework\application\IApplication
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
	 * @return \Supah_Framework\application\Configuration
	 */
	function getConfiguration();

	/**
	 * Gets the application for this module.
	 *
	 * @return \Supah_Framework\application\IApplication
	 */
	function getApplication();

	/**
	 * Gets the routes for the Routing class.
	 *
	 * @return array
	 */
	function getRoutes();
}