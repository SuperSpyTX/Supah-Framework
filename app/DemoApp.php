<?php
/**
 * Class DemoApp.php
 * 
 * @author SuperSpyTX
 */

class DemoApp implements Supah_Framework\application\Application {
	private $system;

	function __construct($system) {
		$this->system = $system;
	}

	public function getName() {
		return "Demo Application";
	}

	public function getRoutes() {
		return array("routetest" => APP_DIR."routing/routetest.php");
	}
}

function getApplication($system) {
	return new DemoApp($system);
}