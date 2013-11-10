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
	private $filter, $matchType, $additionalQueryData, $compressResult;

	/**
	 * Constructs the Filter class.
	 *
	 * @param array $filter array
	 * @param string $matchType string
	 * @param string $additionalQueryData string
	 * @param bool $compressResult bool
	 */
	function __construct($filter = array(), $matchType = FILTER_EQUALS, $additionalQueryData = "", $compressResult = false) {
		$this->filter = $filter;
		$this->matchType = $matchType;
		$this->additionalQueryData = $additionalQueryData;
		$this->compressResult = $compressResult;
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

	/**
	 * Gets whether this should compress the row or not into a single array
	 * NOTE: Only results that return ONE row will have this effect!
	 * WARNING: This is implementation specific!
	 *
	 * @return bool
	 */
	function getCompressResult() {
		return $this->compressResult;
	}

	/**
	 * Sets whether this should compress the row or not into a single array
	 * NOTE: Only results that return ONE row will have this effect!
	 * WARNING: This is implementation specific!
	 *
	 * @param bool
	 */
	function setCompressResult($bool) {
		$this->compressResult = $bool;
	}
}