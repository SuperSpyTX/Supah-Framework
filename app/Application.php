<?php
/**
 * Class Application.php
 *
 * @author SuperSpyTX
 */

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

class DemoApplication implements Supah_Framework\application\IApplication {
	private $system;

	function __construct($system) {
		$this->system = $system;
	}

	public function getName() {
		return "Demo Application";
	}

	public function getRoutes() {
		// TODO: custom configuration for application URIs.
		return array("default" => new DefaultRoute("default"), "error" => new RouteError("error"), "routetest" => new RouteTest("routetest"), "joeks" => new JokesRoute("joeks"));
	}
}