<?php
/**
 * Class Database.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework;

use Supah_Framework\database\IDatabase;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

/**
 * Class Database
 * The class that allows you to set & get stuff for the application.
 *
 * @package Supah_Framework
 */
class Database implements IDatabase {
	private $system, $dbDriver;

	/**
	 * Constructs the Database class.
	 *
	 * @param $system System
	 * @param $dbDriverName string
	 */
	function __construct($system, $dbDriverName) {
		$this->system = $system;
		if ($dbDriverName == null) {
			// empty db class with isEnabled() false.
		} else {
			include(SYSTEM_DIR . "database/drivers/" . $dbDriverName . "Database.php");
			$this->dbDriver = $database($this);
		}
	}

	/**
	 * Gets the database driver.
	 *
	 * @deprecated The Database class already implements the specific methods that the driver implements, no need to use this!
	 * @return IDatabase
	 */
	function getDriver() {
		return $this->dbDriver;
	}

	/**
	 * Returns whether the database is enabled in the configuration or not.
	 *
	 * @return bool
	 */
	function isEnabled() {
		return $this->dbDriver != null;
	}

	/**
	 * Gets the configuration
	 *
	 * @return Configuration
	 */
	function getConfiguration() {
		return $this->system->getConfiguration()->getConfig("db");
	}

	function insert($table, $entries) {
		return $this->dbDriver->insert($table, $entries);
	}

	function select($what, $table, $filter = null) {
		return $this->dbDriver->select($what, $table, $filter);
	}

	function update($table, $toSet, $filter) {
		return $this->dbDriver->update($table, $toSet, $filter);
	}

	function delete($table, $filter) {
		return $this->dbDriver->delete($table, $filter);
	}
}