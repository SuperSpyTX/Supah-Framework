<?php
/**
 * Class IDatabase.php
 * 
 * @author SuperSpyTX
 */

namespace Supah_Framework\database;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

interface IDatabase {
	function __construct($database);

	function insert($table, $entries);

	function select($what, $table, $filter = array());

	function update($table, $toSet, $filter);

	function delete($table, $filter);
}