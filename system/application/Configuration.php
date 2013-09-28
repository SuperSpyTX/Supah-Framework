<?php
/**
 * Class Configuration.php
 *
 * @author SuperSpyTX
 */

// TODO: append "\application" at the end of namespace?
namespace Supah_Framework;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

class Configuration {
	public $config;

	function __construct($config) {
		$this->config = $config;
	}

	function getConfig($module) {
		if (!is_array($this->config[$module]))
			return new Configuration(array()); // for compatibility reasons, empty arrays are better than false.

		return new Configuration($this->config[$module]);
	}

	function getValue($key) {
		return $this->config[$key];
	}

	function getValueWithDef($key, $def) {
		if (!$this->isKeySet($key))
			return $def;

		return $this->getValue($key);
	}

	function isKeySet($key) {
		return isset($this->config[$key]);
	}
}