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
	public static function buildList($list, $cmd = "") {
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

	public static function buildArray($array, $cmd = "") {
		$data = array();
		$ps1 = "(";
		$ps2 = " ".$cmd." (";
		if (is_array($list) && count($list) > 0) {
			foreach ($array as $key => $value) {
				$ps1 .= "`".$key."`,";
				$ps2 .= "?,";
				array_push($data, $value);
			}

			// Strip the last comma and add ending parenthese.
			$ps1 = substr($ps1, 0, strlen($ps1) - 1).")";
			$ps2 = substr($ps2, 0, strlen($ps2) - 1).")";
		}

		return array("append_stmt" => $ps1.$ps2, "data" => $data);
	}

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