<?php
/**
 * Class Scripts.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework;

use Supah_Framework\scripts\Script;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

/**
 * Class Scripts
 * The class that basically have these so called "scripts" callback data based on input or no input.
 *
 * @package Supah_Framework
 */
class Scripts {
	private $system;

	/**
	 * Constructs the Scripts class.
	 *
	 * @param $system System
	 */
	function __construct($system) {
		$this->system = $system;
	}

	/**
	 * Loads a script.
	 * NOTE: The name of the script is relative to your application directory's "scripts" folder.
	 * WARNING: DO NOT INCLUDE .PHP AT THE END OF THE SCRIPT NAME!!!
	 *
	 * @param $script_name string
	 * @param array $args
	 * @return Script
	 */
	function load($script_name, $args = array()) {
		return new Script($script_name, $args);
	}
}