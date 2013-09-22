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
interface IRoute {
	/**
	 * Constructor that accepts a URI as an argument
	 *
	 * @param $uri string
	 * @param $module \Supah_Framework\application\IModule
	 */
	public function __construct($uri, $module);

	/**
	 * Routes the web request to this class.
	 *
	 * @return void
	 */
	function route($uri);

	/**
	 * Checks if the URI matches the rules specified in the route.
	 *
	 * @param $uri string
	 * @return boolean
	 */
	public function ruleMatches($uri);
}