<?php
/**
 * Class StringUtility.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework\utilities;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

/**
 * Class StringUtility
 * This utility is the string doctor.  It has a PhD in string manipulation.
 *
 * @package Supah_Framework\utilities
 */
class StringUtility {
	/**
	 * Checks whether a string starts with a particular match or not.  Basically a String.startsWith() PHP equivalent.
	 * NOTE: This is from stack overflow.
	 *
	 * @param $haystack string
	 * @param $needle string
	 * @return bool
	 */
	public static function startsWith($haystack, $needle) {
		return $needle === "" || strpos($haystack, $needle) === 0;
	}

	/**
	 * Checks whether a string starts with a particular match or not.  Basically a String.startsWith() PHP equivalent.
	 * NOTE: This is from stack overflow.
	 *
	 * @param $haystack string
	 * @param $needle string
	 * @return bool
	 */
	public static function endsWith($haystack, $needle) {
		return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
	}

	/**
	 * A minor improved version of htmlentities(), just putting "&nbsp;" in spaces.
	 *
	 * @param $string string
	 * @return string
	 */
	public static function htmlentities($string) {
		$newStr = htmlentities($string);
		$newStr = str_replace(" ", "&nbsp;", $newStr);

		return $newStr;
	}

	/**
	 * Generates a random string.
	 *
	 * @param int $length
	 * @return string
	 */
	public static function generate($length = 5) {
		$arr = explode(",", "a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,1,2,3,4,5,6,7,8,9,0");
		$str = "";
		for ($i = 0; $i < $length; $i++)
			$str .= $arr[rand(0, count($arr))];

		return $str;
	}
}