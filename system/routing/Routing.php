<?php
/**
 * Class Routing.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework;

class Routing {
	private $system;
	private $routes;

	function __construct($system) {
		$this->system = $system;
		$this->routes = array('default' => 'routing/default.php');
		$this->addRoutes($system->getApplication()->getRoutes());
	}

	function addRoute($uri, $path) {
		$this->addRoutes(array($uri => $path));
	}

	function addRoutes($array) {
		$this->routes = array_merge($array, $this->routes);
	}

	function routeRequest() {
		// TODO: Split the URI query.
		// TODO: Auto detection with /index.php/
		$uri = str_replace(BASE_URI, '', $_SERVER['REQUEST_URI']);
		if ($uri != "") {
			if (isset($uri, $this->routes[$uri])) {
				$goto = $this->routes[$uri];
				include($goto);
			} else {
				// TODO: 404 page template.
				die("TODO: 404 page template.");
			}
		} else {
			if (!isset($this->routes["default"])) {
				die("The default template does not exist. What happened?");
			}
			include($this->routes["default"]);
		}

	}
}