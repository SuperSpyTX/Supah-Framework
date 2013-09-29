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

class Scripts {
	private $system, $scripts;

	function __construct($system) {
		$this->system = $system;
	}

	function load($script_name, $args = array()) {
		return new Script($script_name, $args);
	}
}