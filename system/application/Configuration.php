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

/**
 * Class Configuration
 * The dynamic configuration class used by both the framework and application.
 *
 * @package Supah_Framework
 */
class Configuration {
	public $config;

	/**
	 * Constructs the Configuration class.
	 *
	 * @param $config array
	 */
	function __construct($config) {
		$this->config = $config;
	}

	/**
	 * Gets the configuration section.
	 *
	 * @param $section string
	 * @return Configuration
	 */
	function getConfig($section) {
		if (!is_array($this->config[$section]))
			return new Configuration(array()); // for compatibility reasons, empty arrays are better than false.

		return new Configuration($this->config[$section]);
	}

	/**
	 * Gets the value from the specified key.
	 *
	 * @param $key string
	 * @return mixed
	 */
	function getValue($key) {
		return $this->config[$key];
	}

	/**
	 * Gets the value from the specified key.  If it's not set, the specified default is returned.
	 *
	 * @param $key string
	 * @param $def mixed
	 * @return mixed
	 */
	function getValueWithDef($key, $def) {
		if (!$this->isKeySet($key))
			return $def;

		return $this->getValue($key);
	}

	/**
	 * Gets whether the key has a value set or not.
	 *
	 * @param $key string
	 * @return bool
	 */
	function isKeySet($key) {
		return isset($this->config[$key]);
	}
}