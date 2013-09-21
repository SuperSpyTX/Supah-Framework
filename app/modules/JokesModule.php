<?php
/**
 * Class JokesModule.php
 * 
 * @author SuperSpyTX
 */

class JokesModule implements \Supah_Framework\modules\IModule {
	private $application;

	function __construct($application) {
		$this->application = $application;
	}

	function exec() {
		include(APP_DIR . "controllers/jokes/JokesController.php");
		include(APP_DIR . "routing/jokes/JokesRoute.php");

		$this->application->getSystem()->getRouting()->addRoutes($this->getRoutes());
	}

	function isEnabled() {
		return true;
	}

	public function getRoutes() {
		// TODO: configurable application URIs.
		return array('joeks' => new JokesRoute('joeks'));
	}
}