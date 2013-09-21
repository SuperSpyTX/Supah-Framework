<?php
/**
 * Class RouteError.php
 * 
 * @author SuperSpyTX
 */

class RouteError implements \Supah_Framework\routing\IRoute {
	private $uri;

	public function __construct($uri) {
		$this->uri = $uri;
	}

	public function exec() {
		// TODO: automatically interpret the issue and/or add to constructor?
		$errorController = new ErrorController($this->uri, array("error" => "404"));
		$errorController->exec();
	}

	public function ruleMatches($uri) {
		return true;
	}
}