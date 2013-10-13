<?php
/**
 * Class IApplication.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework\application;

use Supah_Framework\Configuration;
use Supah_Framework\System;

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
	 * @param $system System
	 */
	function __construct($system);

	/**
	 * Gets the main framework class, known as System.
	 *
	 * @return System
	 */
	function getSystem();

	/**
	 * Adds a module.
	 *
	 * @param $name string
	 * @param $class IModule
	 * @return void|bool
	 */
	function addModule($name, $class);

	/**
	 * Checks if a module specified by name is loaded.
	 *
	 * @param $name string
	 * @return bool
	 */
	function isModuleLoaded($name);

	/**
	 * Gets a specific module specified by name.
	 *
	 * @param $name string
	 * @return IModule
	 */
	function getModule($name);

	/**
	 * Gets the configuration class.
	 *
	 * @return Configuration
	 */
	function getConfiguration();

	/**
	 * Gets the name of the application.
	 *
	 * @return string
	 */
	public function getName();

	/**
	 * Gets the properly formatted name of the application.
	 *
	 * @return string
	 */
	public function getTitle();

	/**
	 * Gets the modules included in the application.
	 *
	 * @return array
	 */
	public function getModules();
}