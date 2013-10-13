<?php
/**
 * Class DatabaseUtility.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework\utilities;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

/**
 * Class DatabaseUtility
 * This utility has functions that should be used by database drivers.
 *
 * @package Supah_Framework\utilities
 */
class DatabaseUtility {
	/**
	 * Merges an array with keys reordered.
	 * NOTE: This should not be used for 2 dimensional arrays!
	 *
	 * @param $origArr array
	 * @param $appendArr array
	 * @return array
	 */
	public static function addToArray($origArr, $appendArr) {
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
}