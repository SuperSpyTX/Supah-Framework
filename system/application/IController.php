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
	 * Constructor that accepts a URI and arguments.
	 *
	 * @param $uri the URI of the web request.  Passed by a route class.
	 * @param $args the controller arguments.
	 */
	function __construct($uri, $args);
}