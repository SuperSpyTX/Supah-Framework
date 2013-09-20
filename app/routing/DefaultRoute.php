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

	public function route($uri) {
		$controller = new DefaultController($uri, null);
		$controller->exec();
	}

	public function ruleMatches($uri) {
		return Supah_Framework\utilities\StringUtility::startsWith($uri, $this->uri);
	}
}