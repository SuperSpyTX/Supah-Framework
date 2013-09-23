<?php
/**
 * Class JokesModule.php
 *
 * @author SuperSpyTX
 */

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

class JokesModule implements \Supah_Framework\application\IModule {
	private $application, $config;

	function __construct($application) {
		$this->application = $application;
	}

	function exec() {
		include(APP_DIR . "controllers/jokes/JokesController.php");
		include(APP_DIR . "routing/jokes/JokesRoute.php");

		$this->application->getSystem()->getRouting()->addRoutes($this->getRoutes());
	}

	public static function getName() {
		return "jokes";
	}

	function getConfiguration() {
		if ($config == null)
			$this->config = $this->application->getConfiguration()->getConfig($this->getName());

		return $this->config;
	}

	function isEnabled() {
		return $this->getConfiguration()->getValueWithDef("enabled", true);
	}

	public function getRoutes() {
		// TODO: configurable application URIs.
		return array('jokes' => new JokesRoute('jokes', $this));
	}
}