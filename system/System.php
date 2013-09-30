<?php
/**
 * Class System.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

class System implements \Supah_Framework\application\IExecutable {
	private $base_application, $config, $database, $modules, $routing, $scripts, $templates;

	function __construct($uri, $config) {
		require(APP_DIR . "init.php");
		$this->base_application = $application($this);
		$this->config = new Configuration($config);
		$this->routing = new Routing($this, $uri);
		$this->scripts = new Scripts($this);
		$this->templates = new Templates($this);
		$this->modules = array();

		$application = $this->base_application;
	}

	function exec() {
		if (!$this->config->getConfig("app")->getValueWithDef("enabled", true)) {
			die("This application is currently disabled in the configuration.  If you are the website owner, please set ['app']['enabled'] to true.");
		}

		if ($this->config->getConfig("db")->getValueWithDef("enabled", true)) {
			$this->database = new Database($this, $this->config->getConfig("db")->getValue("driver"));
		} else {
			$this->database = new Database($this, null);
		}

		foreach ($this->getApplication()->getModules() as $name => $class) {
			if ($class->isEnabled()) {
				$class->exec();
				$this->modules = array_merge(array($name => $class), $this->modules);
			}
		}

		$this->getRouting()->exec();
	}

	function getApplication() {
		return $this->base_application;
	}

	function getConfiguration() {
		return $this->config;
	}

	function getDatabase() {
		return $this->database;
	}

	function getRouting() {
		return $this->routing;
	}

	function getScripts() {
		return $this->scripts;
	}

	function getTemplates() {
		return $this->templates;
	}

	function getVersion() {
		return "1.0 Development";
	}
}