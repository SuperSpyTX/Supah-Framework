<?php
/**
 * Class Routing.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework;

use Supah_Framework\utilities\URIUtility;

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
	private $system, $routes, $uri;

	/**
	 * Basic constructor which accepts a URI.
	 *
	 * @param $system \Supah_Framework\System
	 */
	function __construct($system, $uri) {
		$this->system = $system;
		$this->routes = array();
		$this->uri = $uri;
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

	function exec() {
		$fullUri = URIUtility::parseURI($this->uri);
		$uri = $fullUri[0];
		$goto = null;
		if ($uri != "") {
			if (isset($uri, $this->routes[$uri])) {
				$goto = $this->routes[$uri];
			}
		} else {
			if (!isset($this->routes[$this->system->getApplication()->getConfiguration()->getValueWithDef("default.route", "default")])) {
				die("The default template does not exist. What happened?");
			}
			$goto = $this->routes[$this->system->getApplication()->getConfiguration()->getValueWithDef("default.route", "default")];
		}

		if ($goto == null || $goto != $this->routes[$this->system->getApplication()->getConfiguration()->getValueWithDef("default.route", "default")] && !$goto->ruleMatches($fullUri)) {
			if (!isset($this->routes[$this->system->getApplication()->getConfiguration()->getValueWithDef("error.route", "error")])) {
				die("The error template does not exist. What happened?");
			}
			$goto = $this->routes[$this->system->getApplication()->getConfiguration()->getValueWithDef("error.route", "error")];
		}

		$goto->route(URIUtility::removeFirst($fullUri));
	}
}