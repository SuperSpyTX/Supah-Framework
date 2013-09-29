<?php
/**
 * Class MySQLDatabase.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework\database;

use Supah_Framework\utilities\DatabaseUtility;

define("FILTER_EQUALS", "=");
define("FILTER_PARTIAL", "LIKE");
define("FILTER_PARTIAL_OPPOSITE", "NOT LIKE");

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

class MySQLDatabase implements IDatabase {
	private $database, $mysqlObject, $operands;

	function __construct($database) {
		$this->database = $database;
		$pdo = "mysql:dbname=" . $database->getConfiguration()->getValue("database") . ";host=" . $database->getConfiguration()->getValue("host") . ";port=" . $database->getConfiguration()->getValueWithDef("port", "3306") . ";";
		$this->mysqlObject = new \PDO($pdo, $database->getConfiguration()->getValue("username"), $database->getConfiguration()->getValue("password"));
	}

	private function buildList($list, $cmd = "", $sep = "") {
		$data = array();
		$stmt = "";
		if (is_array($list) && count($list) > 0) {
			$stmt .= (strlen($cmd) > 0 ? " " . $cmd . " " : "");
			foreach ($list as $key => $value) {
				$stmt .= "" . $key . " " . $sep . " ?,";
				array_push($data, $value);
			}

			// Strip the last comma.
			$stmt = substr($stmt, 0, strlen($stmt) - 1);
		}

		return array("append_stmt" => $stmt, "data" => $data);
	}

	private function buildArray($array, $cmd = "") {
		$data = array();
		$ps1 = "(";
		$ps2 = " " . $cmd . " (";
		if (is_array($list) && count($list) > 0) {
			foreach ($array as $key => $value) {
				$ps1 .= "`" . $key . "`,";
				$ps2 .= "?,";
				array_push($data, $value);
			}

			// Strip the last comma and add ending parenthese.
			$ps1 = substr($ps1, 0, strlen($ps1) - 1) . ")";
			$ps2 = substr($ps2, 0, strlen($ps2) - 1) . ")";
		}

		return array("append_stmt" => $ps1 . $ps2, "data" => $data);
	}

	private function query($query, $data) {
		$pstmt = $this->mysqlObject->prepare($query);

		if (!$pstmt->execute($data)) {
			return false;
		} else {
			return $pstmt->fetchAll();
		}
	}

	function insert($table, $entries) {
		$processed = $this->buildArray($entries, "VALUES");
		$data = $processed['data'];
		$stmt = "INSERT INTO " . $table . " " . $processed['append_stmt'];

		return $this->query($stmt, $data);
	}

	function select($what, $table, $filter = null) {
		$data = array();
		$where = ($filter != null ? $this->buildList($filter->getFilter(), "WHERE", $filter->getType()) : "");
		$data = DatabaseUtility::addToArray($data, $where['data']);
		$where = $where['append_stmt'];

		$stmt = "SELECT " . $what . " FROM " . $table . "" . $where;

		return $this->query($stmt, $data);
	}

	function update($table, $toSet, $filter) {
		if ((!is_array($toSet) || count($toSet) < 1) && (!$filter instanceof Filter || count($filter->getFilter()) < 1)) {
			return false;
		}

		$data = array();

		$set = $this->buildList($toSet, "SET");
		$data = DatabaseUtility::addToArray($data, $set['data']);
		$set = $set['append_stmt'];

		$where = $this->buildList($filter->getFilter(), "WHERE", $filter->getType());
		$data = DatabaseUtility::addToArray($data, $where['data']);
		$where = $where['append_stmt'];

		$stmt = "UPDATE " . $table . "" . $set . "" . $where);

		return $this->query($stmt, $data);
	}

	function delete($table, $filter) {
		if (!$filter instanceof Filter || count($filter->getFilter()) < 1) {
			return false;
		}

		$data = array();
		$where = $this->buildList($filter->getFilter(), "WHERE", $filter->getType());
		$data = DatabaseUtility::addToArray($data, $set['data']);
		$where = $where['append_stmt'];

		$stmt = "DELETE FROM " . $table . "" . $where;

		return $this->query($stmt, $data);
	}
}

$database = function ($database) {
	return new MySQLDatabase($database);
};