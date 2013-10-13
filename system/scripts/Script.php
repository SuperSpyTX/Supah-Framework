<?php
/**
 * Class Script.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework\scripts;

use Supah_Framework\application\IExecutable;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

/**
 * Class Script
 * This class identifies a script that can be executed.
 *
 * @package Supah_Framework\scripts
 */
class Script implements IExecutable {
	private $script_name, $script_path, $args;

	/**
	 * Constructs the Script class.
	 *
	 * @param $script_name string
	 * @param array $args array
	 */
	function __construct($script_name, $args = array()) {
		$this->script_name = $script_name;
		$this->script_path = APP_DIR . "scripts/" . $script_name . ".php";
		$this->args = $args;
	}

	/**
	 * Executes the script.
	 *
	 * @return bool|void
	 */
	function exec() {
		if (!file_exists($this->getPath())) {
			return false;
		}
		if (isset($script)) {
			unset($script);
		}

		include($this->getPath());

		return $script($this->args);
	}

	/**
	 * Such brilliance!
	 *
	 * @return bool|string
	 */
	function __toString() {
		return $this->exec(); // HOLY CRAP!!!
	}

	/**
	 * Gets this script's name.
	 *
	 * @return string
	 */
	function getName() {
		return $this->script_name;
	}

	/**
	 * Gets this script's file path.
	 *
	 * @return string
	 */
	function getPath() {
		return $this->script_path;
	}

	/**
	 * Gets this script's passed arguments.
	 *
	 * @return array
	 */
	function getArguments() {
		return $this->args;
	}
}