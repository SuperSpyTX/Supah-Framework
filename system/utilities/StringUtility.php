<?php
/**
 * Class StringUtility.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework\utilities;


class StringUtility {
	function startsWith($haystack, $needle) {
		return $needle === "" || strpos($haystack, $needle) === 0;
	}

	function endsWith($haystack, $needle) {
		return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
	}
}