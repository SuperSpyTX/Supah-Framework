<?php
/**
 * Class DefaultModule.php
 *
 * @author SuperSpyTX
 */

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

class DefaultModule implements \Supah_Framework\application\IModule {
	private $application;

	function __construct($application) {
		$this->application = $application;
	}

	function exec() {
		// Include all the things!
		include(APP_DIR . "controllers/DefaultController.php");
		include(APP_DIR . "controllers/ErrorController.php");
		include(APP_DIR . "routing/DefaultRoute.php");
		include(APP_DIR . "routing/RouteTest.php");
		include(APP_DIR . "routing/RouteError.php");

		$this->application->getSystem()->getRouting()->addRoutes($this->getRoutes());
	}

	public static function getName() {
		return "default";
	}

	function getConfiguration() {
		if ($config == null)
			$this->config = $this->application->getConfiguration()->getConfig($this->getName());

		return $this->config;
	}

	function isEnabled() {
		return true;
	}

	public function getRoutes() {
		// TODO: configurable application URIs.
		return array('default' => new DefaultRoute("default", $this), 'error' => new RouteError("error", $this), 'routetest' => new RouteTest("routetest", $this));
	}
}