<?php
/**
 * Class Filter.php
 * 
 * @author SuperSpyTX
 */

namespace Supah_Framework\database;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

/**
 * Class Filter
 * This class filters searches in the database.
 *
 * @package Supah_Framework\database
 */
class Filter {
	private $filter, $matchType, $additionalQueryData;

	/**
	 * Constructs the Filter class.
	 *
	 * @param array $filter array
	 * @param string $matchType string
	 * @param string $additionalQueryData string
	 */
	function __construct($filter = array(), $matchType = FILTER_EQUALS, $additionalQueryData = "")  {
		$this->filter = $filter;
		$this->matchType = $matchType;
		$this->additionalQueryData = $additionalQueryData;
	}

	/**
	 * Gets the filter string.
	 *
	 * @return array
	 */
	function getFilter() {
		return $this->filter;
	}

	/**
	 * Gets the match type.
	 * WARNING: This is implementation specific!
	 *
	 * @return string
	 */
	function getType() {
		return $this->matchType;
	}

	/**
	 * Gets additional query data for the database.
	 * WARNING: This is implementation specific!
	 *
	 * @return string
	 */
	function getAdditionalQueryData() {
		return $this->additionalQueryData;
	}
}