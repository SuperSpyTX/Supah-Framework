<?php
/**
 * Class IExecutable.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework\application;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

/**
 * Class IExecutable
 * Interface that identifies a class that it can be "executed"
 * to perform functions.
 *
 * @package Supah_Framework\application
 */
interface IExecutable {
	/**
	 * Executes the class, performing actions that
	 * can possibly complete the request.
	 *
	 * @return void
	 */
	function exec();
}