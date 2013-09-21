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

	public function exec() {
		$controller = new JokesController($this->uri, array("smallpenises" => "Scetch,hcherndon", "madbros" => "hcherndon"));
		$controller->exec();
	}

	public function ruleMatches($uri) {
		return Supah_Framework\utilities\StringUtility::startsWith($uri, $this->uri);
	}
}