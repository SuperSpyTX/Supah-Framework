<?php
/**
 * Class default.php
 *
 * @author SuperSpyTX
 */

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

class DefaultRoute implements Supah_Framework\IRoute {
	public function route($uri) {
		echo("You wat.<br><br> Meanwhile in iTunes... <br><br>\"People like us we've gotta stick together keep your head up, nothing lasts forever Here's to the damned, to the lost and forgotten.  It's hard to get high when you're living on the bottom\" - Kelly Clarkson");
	}

	public function ruleMatches($uri) {
		// TODO: Figure out an less ugly way to use utility classes.
		global $system;

		return $system->getUtilities()->getString()->startsWith($uri, "default");
	}
}