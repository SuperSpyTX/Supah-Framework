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
	private $system, $config;

	function __construct($system) {
		$this->system = $system;
	}

	public function getSystem() {
		return $this->system;
	}

	public function getConfiguration() {
		if ($this->config == null)
			$this->config = $this->system->getMainConfiguration()->getConfig("app");

		return $this->config;
	}

	public function getName() {
		return $this->getConfiguration()->getValue("name");
	}

	public function getTitle() {
		return $this->getConfiguration()->getValue("title");
	}

	public function getModules() {
		return array(DefaultModule::getName() => new DefaultModule($this), JokesModule::getName() => new JokesModule($this));
	}
}