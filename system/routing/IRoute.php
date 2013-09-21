<?php
/**
 * Class IRoute.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework\routing;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

/**
 * Class IRoute
 * Interface that identifies a route the Routing class can use.
 *
 * @package Supah_Framework\routing
 */
interface IRoute extends \Supah_Framework\application\IExecutable {
	/**
	 * Constructor that accepts a URI as an argument
	 *
	 * @param $uri
	 */
	public function __construct($uri);

	/**
	 * Checks if the URI matches the rules specified in the route.
	 *
	 * @param $uri string
	 * @return boolean
	 */
	public function ruleMatches($uri);
}