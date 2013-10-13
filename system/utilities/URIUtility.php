<?php
/**
 * Class URIUtility.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework\utilities;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

/**
 * Class URIUtility
 * This utility, like StringUtility, has a PhD in URI query structures.
 *
 * @package Supah_Framework\utilities
 */
class URIUtility {
	/**
	 * Parses the raw URI string and returns an array.
	 *
	 * @param $uri string
	 * @return array
	 */
	public static function parseURI($uri) {
		// Strip /index.php and script location URI.
		$uri = substr($uri, strlen(BASE_URI));
		$uri = str_replace(THIS_SCRIPT, '', $uri);

		// Split into array with a filter.
		$uriArr = array_filter(explode("/", $uri));

		// Sort it (so any fucked up queries are stripped).
		$uriArr = URIUtility::resortArray($uriArr);

		return $uriArr;
	}

	/**
	 * A better way of resorting an array, similar to DatabaseUtility's addToArray().
	 *
	 * @param $arr array
	 * @return array
	 */
	public static function resortArray($arr) {
		$i = 0;
		if (count($arr) < 1)
			return $arr;

		foreach ($arr as $key => $value) {
			$nArr[$i++] = $value;
		}

		return $nArr;
	}

	/**
	 * Removes the first entry in the array, or the first /slash/ in the URI in this case.
	 *
	 * @param $uri array
	 * @return array
	 */
	public static function removeFirst($uri) {
		$uriArr = $uri;
		unset($uriArr[0]);

		return URIUtility::resortArray($uriArr); // TODO: Decide if we need resortArray with removeFirst()
	}
}