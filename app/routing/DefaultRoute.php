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
	private $uri;

	public function __construct($uri) {
		$this->uri = $uri;
	}

	public function exec() {
		$controller = new DefaultController($this->uri, null);
		$controller->exec();
	}

	public function ruleMatches($uri) {
		return true;
	}
}