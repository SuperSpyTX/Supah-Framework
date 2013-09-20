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

class Routing {
	private $system;
	private $routes;

	function __construct($system) {
		$this->system = $system;
		$this->routes = array();
		$this->addRoutes($system->getApplication()->getRoutes());
	}

	function addRoute($uri, $path) {
		$this->addRoutes(array($uri => $path));
	}

	function addRoutes($array) {
		$this->routes = array_merge($array, $this->routes);
	}

	// TODO: Come up with a better name for this function and/or figure out a better way to start traveling in the framework.
	function routeRequest() {
		// TODO: Split the URI query.
		// TODO: Auto detection with /index.php/
		$uri = str_replace(BASE_URI, '', $_SERVER['REQUEST_URI']);
		$goto = null;
		$defaultMode = false;
		if ($uri != "") {
			if (isset($uri, $this->routes[$uri])) {
				$goto = $this->routes[$uri];
			}
		} else {
			if (!isset($this->routes["default"])) {
				die("The default template does not exist. What happened?");
			}
			$goto = $this->routes["default"];
			$defaultMode = true;
		}

		if ($goto == null || $goto != $this->routes["default"] && !$goto->ruleMatches($uri) == 1) {
			// TODO: 404 page template.
			die("TODO: 404 page template.");
		}

		$goto->route($uri);
	}
}