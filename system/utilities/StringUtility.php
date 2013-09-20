<?php
/**
 * Class StringUtility.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}


class StringUtility {
	// From stackoverflow
	function startsWith($haystack, $needle) {
		$i = $needle === "" || strpos($haystack, $needle) === 0;

		return $i == 1;
	}

	function endsWith($haystack, $needle) {
		$i = $needle === "" || substr($haystack, -strlen($needle)) === $needle;

		return $i == 1;
	}
}