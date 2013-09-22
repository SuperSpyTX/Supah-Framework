<?php
/**
 * Class System.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework;

use Supah_Framework\application\Configuration;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

class System implements \Supah_Framework\application\IExecutable {
	private $base_application, $config, $modules, $routing, $templates;

	function __construct($base_application_path, $uri, $config) {
		if ($this->base_application == null) {
			require($base_application_path);
			$this->base_application = $application($this);
			$this->config = new Configuration($config);
			$this->modules = array();
			$this->routing = new Routing($this, $uri);
			$this->templates = new Templates($this);

			foreach ($this->getApplication()->getModules() as $name => $class) {
				if ($class->isEnabled()) {
					$class->exec();
					$this->modules = array_merge(array($name => $class), $this->modules);
				}
			}

			$application = $this->base_application;
		}
	}

	function exec() {
		$this->getRouting()->exec();
	}

	function getApplication() {
		return $this->base_application;
	}

	function isModuleLoaded($name) {
		return isset($this->modules[$name]);
	}

	/**
	 * Gets a specific module specified by name.
	 *
	 * @param $name string
	 * @return \Supah_Framework\application\IModule
	 */
	function getModule($name) {
		return $this->modules[$name];
	}

	function getMainConfiguration() {
		return $this->config;
	}

	function getConfiguration() {
		return $this->config->getConfig("sys");
	}

	function getRouting() {
		return $this->routing;
	}

	function getTemplates() {
		return $this->templates;
	}
}