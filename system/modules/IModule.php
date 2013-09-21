<?php
/**
 * Class IModule.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework\modules;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

interface IModule extends \Supah_Framework\application\IExecutable {
	/**
	 * Basic constructor.
	 *
	 * @param $application \Supah_Framework\application\IApplication-
	 */
	function __construct($application);

	/**
	 * Returns whether the module is enabled or not.
	 *
	 * @return boolean
	 */
	function isEnabled();

	/**
	 * Gets the routes for the Routing class.
	 *
	 * @return array
	 */
	public function getRoutes();
}