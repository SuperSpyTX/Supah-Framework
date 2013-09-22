<?php
/**
 * Class IApplication.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework\application;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

/**
 * Class IApplication
 * Interface that identifies the application.
 *
 * @package Supah_Framework\application
 */
interface IApplication {
	/**
	 * Basic constructor.
	 *
	 * @param $system \Supah_Framework\System
	 */
	function __construct($system);

	/**
	 * Gets the main framework class, known as System.
	 *
	 * @return \Supah_Framework\System
	 */
	function getSystem();

	/**
	 * Gets the configuration class.
	 *
	 * @return \Supah_Framework\application\Configuration
	 */
	function getConfiguration();

	/**
	 * Gets the name of the application.
	 *
	 * @return string
	 */
	public function getName();

	/**
	 * Gets the properly-formatted name of the application.
	 *
	 * @return string
	 */
	public function getTitle();

	/**
	 * Gets the modules included in the application.
	 *
	 * @return array of modules.
	 */
	public function getModules();
}