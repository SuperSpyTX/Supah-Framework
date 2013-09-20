<?php
/**
 * Class routetest.php
 *
 * @author SuperSpyTX
 */

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

class RouteTest implements Supah_Framework\IRoute {
	public function route($uri) {
		echo("Congratulations, you routed something correctly today!<br><br> Meanwhile in iTunes... <br><br>\"Singing for the people like us, the people like us!\" - Kelly Clarkson");
	}

	public function ruleMatches($uri) {
		// TODO: Figure out an less ugly way to use utility classes.
		global $system;

		return $system->getUtilities()->getString()->startsWith($uri, "routetest");
	}
}