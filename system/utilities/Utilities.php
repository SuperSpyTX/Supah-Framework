<?php
/**
 * Class Utilities.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

class Utilities {
	private $system;
	private $stringUtility;

	function __construct($system) {
		$this->system = $system;
		$this->stringUtility = new StringUtility();
	}

	function getString() {
		return $this->stringUtility;
	}
}