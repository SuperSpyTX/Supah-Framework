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
			include(SYSTEM_DIR . "database/drivers/" . $dbDriverName . "Database.php");
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
		return $this->system->getConfiguration()->getConfig("db");
	}

	function insert($table, $entries) {
		return $this->dbDriver->insert($table, $entries);
	}

	function select($what, $table, $filter = array(), $matchSector = "=") {
		return $this->dbDriver->select($what, $table, $filter, $partialMatch);
	}

	function update($table, $toSet, $filter, $matchSector = "=") {
		return $this->dbDriver->update($table, $toSet, $filter, $partialMatch);
	}

	function delete($table, $filter, $matchSector = "=") {
		return $this->dbDriver->delete($table, $filter, $partialMatch);
	}
}