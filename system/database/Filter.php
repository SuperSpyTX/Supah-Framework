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

class Filter {
	private $filter, $matchType, $additionalQueryData;

	function __construct($filter = array(), $matchType = FILTER_EQUALS, $additionalQueryData = "")  {
		$this->filter = $filter;
		$this->matchType = $matchType;
		$this->additionalQueryData = $additionalQueryData;
	}

	function getFilter() {
		return $this->filter;
	}

	function getType() {
		return $this->matchType;
	}

	// NOTE: This is implementation specific - nothing can be avoided to fix this.
	function getAdditionalQueryData() {
		return $this->additionalQueryData;
	}
}