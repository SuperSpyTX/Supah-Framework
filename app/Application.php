<?php
/**
 * Class Application.php
 *
 * @author SuperSpyTX
 */

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

class DemoApplication implements Supah_Framework\IApplication {
	private $system;

	function __construct($system) {
		$this->system = $system;
	}

	public function getName() {
		return "Demo Application";
	}

	public function getRoutes() {
		// TODO: custom configuration for application URIs.
		return array("default" => new DefaultRoute("default"), "routetest" => new RouteTest("routetest"));
	}
}