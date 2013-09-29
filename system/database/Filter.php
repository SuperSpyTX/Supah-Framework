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
	private $filter, $matchType;

	function __construct($filter = array(), $matchType = FILTER_EQUALS)  {
		$this->filter = $filter;
		$this->matchType = $matchType;
	}

	function getFilter() {
		return $this->filter;
	}

	function getType() {
		return $this->matchType;
	}
}