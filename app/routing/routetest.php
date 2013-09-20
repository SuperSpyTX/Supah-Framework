<?php
/**
 * Class routetest.php
 *
 * @author SuperSpyTX
 */

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

class RouteTest implements Supah_Framework\routing\IRoute {
	private $uri;

	public function __construct($uri) {
		$this->uri = $uri;
	}

	public function route($uri) {
		echo("Congratulations, you routed something correctly today!<br><br> Meanwhile in iTunes... <br><br>\"Singing for the people like us, the people like us!\" - Kelly Clarkson");
	}

	public function ruleMatches($uri) {
		return Supah_Framework\StringUtility::startsWith($uri, $this->uri);
	}
}