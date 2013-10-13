<?php
/**
 * Class System.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework;

use Supah_Framework\application\IExecutable;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

/**
 * Class System
 * The main framework class, hence the name "System".
 *
 * @package Supah_Framework
 */
class System implements IExecutable {
	private $base_application, $config, $database, $modules, $routing, $scripts, $templates;

	/**
	 * Constructs the framework class.
	 *
	 * @param $uri array
	 * @param $config array
	 */
	function __construct($uri, $config) {
		require(APP_DIR . "init.php");
		$this->base_application = $application($this);
		$this->config = new Configuration($config);
		$this->routing = new Routing($this, $uri);
		$this->scripts = new Scripts($this);
		$this->templates = new Templates($this);
		$this->modules = array();
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

	/**
	 * Gets the current application utilizing the framework.
	 *
	 * @return \Supah_Framework\application\IApplication
	 */
	function getApplication() {
		return $this->base_application;
	}

	/**
	 * Gets the Configuration class.
	 *
	 * @return Configuration
	 */
	function getConfiguration() {
		return $this->config;
	}

	/**
	 * Gets the Database class.
	 * NOTE: This returns null if the system has not been executed yet.
	 *
	 * @return \Supah_Framework\Database
	 */
	function getDatabase() {
		return $this->database;
	}

	/**
	 * Gets the Routing class.
	 *
	 * @return Routing
	 */
	function getRouting() {
		return $this->routing;
	}

	/**
	 * Gets the Scripts class.
	 *
	 * @return Scripts
	 */
	function getScripts() {
		return $this->scripts;
	}

	/**
	 * Gets the Templates class.
	 *
	 * @return Templates
	 */
	function getTemplates() {
		return $this->templates;
	}

	/**
	 * Gets the current version of this framework.
	 *
	 * @return string
	 */
	function getVersion() {
		return "1.0 Development";
	}
}