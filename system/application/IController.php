<?php
/**
 * Class IController.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework\application;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

/**
 * Class IController
 * Interface that identifies a controller in the application.
 *
 * @package Supah_Framework\application
 */
interface IController extends IExecutable {
	/**
	 * Constructor that accepts a URI, module, and arguments.
	 *
	 * @param $uri string
	 * @param $module IModule
	 * @param $args array
	 */
	function __construct($uri, $module, $args);
}