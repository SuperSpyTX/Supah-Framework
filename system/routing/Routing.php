<?php
/**
 * Class Routing.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework;

use Supah_Framework\application\IExecutable;
use Supah_Framework\routing\IRoute;
use Supah_Framework\utilities\URIUtility;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

/**
 * Class Routing
 * The class mainly responsible for routing URI structures to specific parts in the application.
 *
 * @package Supah_Framework
 */
class Routing implements IExecutable {
	private $system, $routes, $uri;

	/**
	 * Basic constructor which accepts a URI.
	 *
	 * @param $system System
	 * @param $uri array
	 */
	function __construct($system, $uri) {
		$this->system = $system;
		$this->routes = array();
		$this->uri = $uri;
	}

	/**
	 * Adds multiple routes to the list.
	 *
	 * @param $array array
	 */
	function addRoutes($array) {
		$this->routes = array_merge($array, $this->routes);
	}

	/**
	 * Adds a route to the list.
	 *
	 * @param $uri string
	 * @param $class IRoute
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
			if (!isset($this->routes[$this->system->getApplication()->getConfiguration()->getValueWithDef("route.default", "default")])) {
				die("The default template does not exist. What happened?");
			}
			$goto = $this->routes[$this->system->getApplication()->getConfiguration()->getValueWithDef("route.default", "default")];
		}

		if ($goto == null || $goto != $this->routes[$this->system->getApplication()->getConfiguration()->getValueWithDef("route.default", "default")] && !$goto->ruleMatches($fullUri)) {
			if (!isset($this->routes[$this->system->getApplication()->getConfiguration()->getValueWithDef("route.error", "error")])) {
				die("The error template does not exist. What happened?");
			}
			$goto = $this->routes[$this->system->getApplication()->getConfiguration()->getValueWithDef("route.error", "error")];
			$goto->route($fullUri);
		} else {
			$goto->route(($this->system->getApplication()->getConfiguration()->getValueWithDef("route.forward", true) ? URIUtility::removeFirst($fullUri) : $fullUri));
		}
	}
}