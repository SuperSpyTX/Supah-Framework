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
define("FILTER_LIMIT", "LIMIT ");

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

class MySQLDatabase implements IDatabase {
	private $database, $mysqlObject;

	function __construct($database) {
		$this->database = $database;
		$pdo = "mysql:dbname=" . $database->getConfiguration()->getValue("database") . ";host=" . $database->getConfiguration()->getValue("host") . ";port=" . $database->getConfiguration()->getValueWithDef("port", "3306") . ";";
		$this->mysqlObject = new \PDO($pdo, $database->getConfiguration()->getValue("username"), $database->getConfiguration()->getValue("password"));
	}

	private function buildParameters($list, $cmd = "", $sep = "", $postSep = ",") {
		$data = array();
		$stmt = "";
		if (is_array($list) && count($list) > 0) {
			$stmt .= (strlen($cmd) > 0 ? " " . $cmd . " " : "");
			foreach ($list as $key => $value) {
				$stmt .= "" . $key . " " . $sep . " ?" . $postSep;
				array_push($data, $value);
			}

			// Strip the last post sep
			$stmt = substr($stmt, 0, strlen($stmt) - strlen($postSep));
		}

		return array("append_stmt" => $stmt, "data" => $data);
	}

	private function buildKVQuery($array, $cmd = "") {
		$data = array();
		$ps1 = "(";
		$ps2 = " " . $cmd . " (";
		if (is_array($array) && count($array) > 0) {
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
			if ($pstmt->rowCount() > 0) {
				$obj = $pstmt->fetchAll();
				if (!$obj) {
					return true;
				}
				if ($pstmt->rowCount() == 1) {
					$obj = $obj[0];
				}

				return $obj;
			} else {
				return true;
			}
		}
	}

	function insert($table, $entries) {
		$processed = $this->buildKVQuery($entries, "VALUES");
		$data = $processed['data'];
		$stmt = "INSERT INTO " . $table . " " . $processed['append_stmt'];

		return $this->query($stmt, $data);
	}

	function select($what, $table, $filter = null) {
		$data = array();
		if ($filter instanceof Filter) {
			$where = $this->buildParameters($filter->getFilter(), "WHERE", $filter->getType(), " AND ");
			$data = DatabaseUtility::addToArray($data, $where['data']);
		}
		$where = $where['append_stmt'] . " " . ($filter instanceof Filter ? $filter->getAdditionalQueryData() : "");

		$stmt = "SELECT " . $what . " FROM " . $table . "" . $where;

		return $this->query($stmt, $data);
	}

	function update($table, $toSet, $filter) {
		if ((!is_array($toSet) || count($toSet) < 1) && (!$filter instanceof Filter || count($filter->getFilter()) < 1)) {
			return false;
		}

		$data = array();

		$set = $this->buildParameters($toSet, "SET");
		$data = DatabaseUtility::addToArray($data, $set['data']);
		$set = $set['append_stmt'];

		$where = $this->buildParameters($filter->getFilter(), "WHERE", $filter->getType(), " AND ");
		$data = DatabaseUtility::addToArray($data, $where['data']);
		$where = $where['append_stmt'] . ($filter instanceof Filter ? $filter->getAdditionalQueryData() : "");

		$stmt = "UPDATE " . $table . "" . $set . "" . $where;

		return $this->query($stmt, $data);
	}

	function delete($table, $filter) {
		if (!$filter instanceof Filter || count($filter->getFilter()) < 1) {
			return false;
		}

		$data = array();
		$where = $this->buildParameters($filter->getFilter(), "WHERE", $filter->getType(), " AND ");
		$data = DatabaseUtility::addToArray($data, $where['data']);
		$where = " " . $where['append_stmt'] . ($filter instanceof Filter ? $filter->getAdditionalQueryData() : "");

		$stmt = "DELETE FROM " . $table . "" . $where;

		return $this->query($stmt, $data);
	}
}

$database = function ($database) {
	return new MySQLDatabase($database);
};