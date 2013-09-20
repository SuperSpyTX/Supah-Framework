<?php
/**
 * Class JokesRoute.php
 * 
 * @author SuperSpyTX
 */

class JokesRoute implements \Supah_Framework\routing\IRoute {
	private $uri;

	public function __construct($uri) {
		$this->uri = $uri;
	}

	public function route($uri) {
		$controller = new JokesController($uri, array("smallpenises" => "Scetch,hcherndon", "madbros" => "hcherndon"));
		$controller->exec();
	}

	public function ruleMatches($uri) {
		return Supah_Framework\utilities\StringUtility::startsWith($uri, $this->uri);
	}
}