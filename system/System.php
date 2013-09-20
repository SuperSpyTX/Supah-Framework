<?php
/**
 * Class System.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework;

// TODO: Delegate these includes elsewhere!

// include everything here for now.  This way all the necessary components are loaded.
include(SYSTEM_DIR."application\Application.php");
include(SYSTEM_DIR."routing\Routing.php");

class System {
	private $base_application;
	private $routing;
	private $modules;

	function __construct($base_application_path) {
		if ($this->base_application == null) {
			require_once($base_application_path);
			$this->base_application = getApplication($this);
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