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
		$this->modules = array('default' => new DefaultModule($this));
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
		if ($this->config == null) {
			$this->config = $this->getSystem()->getConfiguration()->getConfig("app");
		}
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