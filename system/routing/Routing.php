<?php
/**
 * Class Routing.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

/**
 * Class Routing
 * The framework for routing web requests.
 *
 * @package Supah_Framework
 */
class Routing implements \Supah_Framework\application\IExecutable {
	private $system;
	private $routes;

	/**
	 * Basic constructor.
	 *
	 * @param $system The main framework class.
	 */
	function __construct($system) {
		$this->system = $system;
		$this->routes = array();
	}

	/**
	 * Adds multiple routes to the list.
	 *
	 * @param $array array of routes.
	 */
	function addRoutes($array) {
		$this->routes = array_merge($array, $this->routes);
	}

	/**
	 * Adds a route to the list.
	 *
	 * @param $uri the URI to route.
	 * @param $class the route class.
	 */
	function addRoute($uri, $class) {
		$this->addRoutes(array($uri => $class));
	}

	// TODO: Come up with a better name for this function and/or figure out a better way to start traveling in the framework.
	function exec() {
		// TODO: Split the URI query.
		// TODO: Auto detection with /index.php/
		$uri = str_replace(BASE_URI, '', $_SERVER['REQUEST_URI']);
		$goto = null;
		if ($uri != "") {
			if (isset($uri, $this->routes[$uri])) {
				$goto = $this->routes[$uri];
			}
		} else {
			if (!isset($this->routes["default"])) {
				die("The default template does not exist. What happened?");
			}
			$goto = $this->routes["default"];
		}

		if ($goto == null || $goto != $this->routes["default"] && !$goto->ruleMatches($uri) == 1) {
			if (!isset($this->routes["error"])) {
				die("The error template does not exist. What happened?");
			}
			$goto = $this->routes["error"];
		}

		$goto->exec($uri);
	}
}