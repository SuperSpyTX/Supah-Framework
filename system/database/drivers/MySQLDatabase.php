<?php
/**
 * Class MySQLDatabase.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework\database;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

class MySQLDatabase implements IDatabase {
	private $database, $mysqlObject, $operands;

	function __construct($database) {
		$this->database = $database;
		$pdo = "mysql:dbname=" . $database->getConfiguration()->getValue("database") . ";host=" . $database->getConfiguration()->getValue("host") . ";port=" . $database->getConfiguration()->getValue("port") . ";";
		$this->mysqlObject = new \PDO($pdo, $database->getConfiguration()->getValue("username"), $database->getConfiguration()->getValue("password"));
	}

	// TODO: Delegate to DatabaseUtilities.
	private function buildList($list, $cmd = "") {
		$data = array();
		$stmt = "";
		if (is_array($list) && count($list) > 0) {
			$stmt .= (strlen($cmd) > 0 ? " " . $cmd . " " : "");
			foreach ($list as $key => $value) {
				$stmt .= "" . $key . " = ?,";
				array_push($data, $value);
			}

			// Strip the last comma.
			$stmt = substr($stmt, 0, strlen($stmt) - 1);
		}

		return array("append_stmt" => $stmt, "data" => $data);
	}

	// TODO: Delegate to DatabaseUtilities.
	private function addToArray($origArr, $appendArr) {
		$newArr = $origArr;
		foreach ($appendArr as $key => $value) {
			if (is_int($key)) {
				$newArr[] = $value;
			} else {
				$newArr[$key] = $value;
			}
		}

		return $newArr;
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

	}

	function select($what, $table, $filter = array()) {
		$data = array();
		$where = $this->buildList($filter, "WHERE");
		$data = $this->addToArray($data, $where['data']);
		$where = $where['append_stmt'];

		$stmt = "SELECT " . $what . " FROM " . $table . "" . $where;

		return $this->query($stmt, $data);
	}

	function update($table, $toSet, $filter) {
		if (!is_array($toSet) || count($toSet) < 1) {
			return false;
		}

		$data = array();

		$set = $this->buildList($toSet, "SET");
		$data = $this->addToArray($data, $set['data']);
		$set = $set['append_stmt'];

		$where = $this->buildList($filter, "WHERE");
		$data = $this->addToArray($data, $where['data']);
		$where = $where['append_stmt'];

		$stmt = "UPDATE " . $table . "" . $this->buildList($toSet, "SET") . $this->buildList($filter, "WHERE");

		return $this->query($stmt, $data);
	}

	function delete($table, $filter) {
		$data = array();
		$where = $this->buildList($filter, "WHERE");
		$data = $this->addToArray($data, $set['data']);
		$where = $where['append_stmt'];

		$stmt = "DELETE FROM " . $table . "" . $where;

		return $this->query($stmt, $data);
	}
}

$database = function ($database) {
	return new MySQLDatabase($database);
};