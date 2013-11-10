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

/**
 * Class IDatabase
 * The interface that drivers must implement to integrate into the framework.
 *
 * NOTE: The naming scheme is implementation specific.
 *
 * @package Supah_Framework\database
 */
interface IDatabase {
	/**
	 * Inserts data into the database.
	 *
	 * @param $table string
	 * @param $entries array
	 * @return bool
	 */
	function insert($table, $entries);

	/**
	 * Retrieves data from the database.
	 *
	 * @param $what string
	 * @param $table string
	 * @param $filter Filter
	 * @return bool|array
	 */
	function select($what, $table, $filter = null);

	/**
	 * Updates data in the database.
	 *
	 * @param $table string
	 * @param $toSet array
	 * @param $filter Filter
	 * @return bool
	 */
	function update($table, $toSet, $filter);

	/**
	 * Deletes data from the database.
	 *
	 * @param $table string
	 * @param $filter Filter
	 * @return bool
	 */
	function delete($table, $filter);
}