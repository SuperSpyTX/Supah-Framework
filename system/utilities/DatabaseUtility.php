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

class DatabaseUtility {
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