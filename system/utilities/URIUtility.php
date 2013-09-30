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

class URIUtility {
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

	// Because of the fact every other PHP function doesn't do this correctly, I have to do it this way.
	public static function resortArray($arr) {
		$i = 0;
		foreach ($arr as $key => $value) {
			$nArr[$i++] = $value;
		}

		return $nArr;
	}

	public static function removeFirst($uri) {
		$uriArr = $uri;
		unset($uriArr[0]);
		return URIUtility::resortArray($uriArr); // TODO: Decide if we need resortArray with removeFirst()
	}
}