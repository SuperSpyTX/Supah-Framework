<?php
/**
 * Class Database.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

class Database {
	private $system, $dbDriver;

	function __construct($system, $dbDriverName) {
		$this->system = $system;
		if ($dbDriverName == null) {
			// empty db class with isEnabled() false.
		} else {
			include(SYSTEM_DIR . "database\\drivers\\" . $dbDriverName . "Database.php");
			$this->dbDriver = $database($this);
		}
	}

	function getDriver() {
		return $this->dbDriver;
	}

	function isEnabled() {
		return $this->dbDriver != null;
	}

	function getConfiguration() {
		return $this->system->getMainConfiguration()->getConfig("db");
	}

	function insert($table, $entries) {
		return $this->dbDriver->insert($table, $entries);
	}

	function select($what, $table, $filter = array()) {
		return $this->dbDriver->select($what, $table, $filter);
	}

	function update($table, $toSet, $filter) {
		return $this->dbDriver->update($table, $toSet, $filter);
	}

	function delete($table, $filter) {
		return $this->dbDriver->delete($table, $filter);
	}
}