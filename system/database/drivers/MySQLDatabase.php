<?php
/**
 * Class MySQLDatabase.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework\database;

use Supah_Framework\utilities\DatabaseUtility;

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

	private function query($query, $data) {
		$pstmt = $this->mysqlObject->prepare($query);

		if (!$pstmt->execute($data)) {
			return false;
		} else {
			return $pstmt->fetchAll();
		}
	}

	function insert($table, $entries) {
		$processed = DatabaseUtility::buildArray($entries, "VALUES");
		$data = $processed['data'];
		$stmt = "INSERT INTO " . $table . " " . $processed['append_stmt'];

		return $this->query($stmt, $data);
	}

	function select($what, $table, $filter = array(), $matchSector = "=") {
		$data = array();
		$where = DatabaseUtility::buildList($filter, "WHERE", $matchSector);
		$data = DatabaseUtility::addToArray($data, $where['data']);
		$where = $where['append_stmt'];

		$stmt = "SELECT " . $what . " FROM " . $table . "" . $where;

		return $this->query($stmt, $data);
	}

	function update($table, $toSet, $filter, $matchSector = "=") {
		if (!is_array($toSet) || count($toSet) < 1) {
			return false;
		}

		$data = array();

		$set = DatabaseUtility::buildList($toSet, "SET");
		$data = DatabaseUtility::addToArray($data, $set['data']);
		$set = $set['append_stmt'];

		$where = DatabaseUtility::buildList($filter, "WHERE", $matchSector);
		$data = DatabaseUtility::addToArray($data, $where['data']);
		$where = $where['append_stmt'];

		$stmt = "UPDATE " . $table . "" . $set . "" . $where);

		return $this->query($stmt, $data);
	}

	function delete($table, $filter, $matchSector = "=") {
		$data = array();
		$where = DatabaseUtility::buildList($filter, "WHERE", $matchSector);
		$data = DatabaseUtility::addToArray($data, $set['data']);
		$where = $where['append_stmt'];

		$stmt = "DELETE FROM " . $table . "" . $where;

		return $this->query($stmt, $data);
	}
}

$database = function ($database) {
	return new MySQLDatabase($database);
};