<?php
/**
 * Class System.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

class System {
	private $base_application;
	private $routing;

	function __construct($base_application_path) {
		if ($this->base_application == null) {
			require_once($base_application_path);
			$this->base_application = $application($this);
			$this->routing = new Routing($this);
		}
	}

	function getApplication() {
		return $this->base_application;
	}

	function getRouting() {
		return $this->routing;
	}
}