<?php
/**
 * Class DemoApp.php
 *
 * @author SuperSpyTX
 */

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

class DemoApp implements Supah_Framework\IApplication {
	private $system;

	function __construct($system) {
		$this->system = $system;
	}

	public function getName() {
		return "Demo Application";
	}

	public function getRoutes() {
		return array("default" => new DefaultRoute(), "routetest" => new RouteTest());
	}
}