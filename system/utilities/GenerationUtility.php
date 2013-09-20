<?php
/**
 * Class GenerationUtility.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework\utilities;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

class GenerationUtility {
	public static function generateLink($script, $comment) {
		return "<a href=\"" . $script . "\">" . $comment . "</a>";
	}

	public static function generateTitle($title) {
		return "<title>" . $title . "</title>";
	}

	// TODO: Implement Key/Value pair list generation (table generation?)
	public static function generateList($array, $break = "<br>", $isKVPair = false) {
		$list = "";
		foreach ($array as $entry) {
			$list .= $entry . $break;
		}

		return $list;
	}
}