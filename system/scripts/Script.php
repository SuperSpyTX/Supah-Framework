<?php
/**
 * Class Script.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework\scripts;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

class Script implements \Supah_Framework\application\IExecutable {
	private $script_name, $script_path, $args;

	function __construct($script_name, $args = array()) {
		$this->script_name = $script_name;
		$this->script_path = APP_DIR . "scripts/" . $script_name . ".php";
		$this->args = $args;
	}

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

	function getName() {
		return $this->script_name;
	}

	function getPath() {
		return $this->script_path;
	}

	function getArguments() {
		return $this->args;
	}
}