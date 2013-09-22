<?php
/**
 * Class DefaultRoute.php
 *
 * @author SuperSpyTX
 */

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

class DefaultRoute implements Supah_Framework\routing\IRoute {
	private $uri, $module;

	public function __construct($uri, $module) {
		$this->uri = $uri;
		$this->module = $module;
	}

	public function route($uri) {
		$controller = new DefaultController($uri, null);
		$controller->exec();
	}

	public function ruleMatches($uri) {
		return true;
	}
}