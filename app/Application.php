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
	private $system, $modules, $config;

	function __construct($system) {
		$this->system = $system;
		$this->config = $this->system->getConfiguration()->getConfig("app");
		$this->modules = array('default' => new DefaultRoute($this));
	}

	public function getSystem() {
		return $this->system;
	}

	public function addModule($name, $class) {
		$this->modules = array_merge(array($name => $class), $this->modules);
	}

	public function isModuleLoaded($name) {
		return getModule($name) != null;
	}

	public function getModule($name) {
		return $this->modules[$name];
	}

	public function getConfiguration() {
		return $this->config;
	}

	public function getName() {
		return $this->getConfiguration()->getValue("name");
	}

	public function getTitle() {
		return $this->getConfiguration()->getValue("title");
	}

	public function getModules() {
		return $this->modules;
	}
}