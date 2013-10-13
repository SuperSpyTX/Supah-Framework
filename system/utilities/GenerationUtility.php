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

/**
 * Class GenerationUtility
 * This utility generates HTML for templates.
 *
 * @package Supah_Framework\utilities
 */
class GenerationUtility {
	/**
	 * Generates a link. The URI can be a full link or a relative link, which will be based on BASE_URI.
	 *
	 * @param $link string
	 * @param $comment string
	 * @return string
	 */
	public static function generateLink($link, $comment) {
		return "<a href=\"" . (StringUtility::startsWith($link, "://") ? $link : substr(BASE_URI, 0, strlen(BASE_URI) - 1)) . "/" . $link . "\">" . $comment . "</a>";
	}

	/**
	 * Generates title tags.
	 *
	 * @deprecated I mean, it's not like you couldn't use the newly and lovely wrapTags().
	 * @param $title
	 * @return string
	 */
	public static function generateTitle($title) {
		return "<title>" . $title . "</title>";
	}

	// TODO: table generation?
	/**
	 * Basically a nerfed implode() that iterates the array and doesn't require a splitting point.
	 * This is mainly used to echo data from arrays, like table entries.
	 *
	 * @param $array array
	 * @param string $break string
	 * @param bool $isKVPair
	 * @param bool $includeKey
	 * @param string $keySep
	 * @return string
	 */
	public static function generateList($array, $break = "<br>", $isKVPair = false, $includeKey = false, $keySep = " - ") {
		$list = "";
		if (!$isKVPair) {
			foreach ($array as $entry) {
				$list .= $entry . $break;
			}
		} else {
			foreach ($array as $key => $value) {
				$list .= ($includeKey ? $key . $keySep : "") . $value . $break;
			}
		}

		return $list;
	}

	/**
	 * Generates HTML tags based on input.
	 *
	 * @deprecated wrapHtmlTags, really? Why "Html" in the method's name?
	 * @param $tag string
	 * @param $value string
	 * @param string $extra
	 * @return string
	 */
	public static function wrapHtmlTags($tag, $value, $extra = "") {
		return ("<" . str_replace("<", "", str_replace(">", "", $tag)) . "" . (strlen(trim($extra)) > 0 ? " " . $extra : "") . ">" . $value . "</" . str_replace("<", "", str_replace(">", "", $tag)) . ">");
	}

	/**
	 * Generates HTML tags based on input.
	 *
	 * @param $tag string
	 * @param $value string
	 * @param string $extra
	 * @return string
	 */
	public static function wrapTags($tag, $value, $extra = "") {
		return ("<" . str_replace("<", "", str_replace(">", "", $tag)) . "" . (strlen(trim($extra)) > 0 ? " " . $extra : "") . ">" . $value . "</" . str_replace("<", "", str_replace(">", "", $tag)) . ">");
	}
}