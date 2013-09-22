<?php
/**
 * Class JokesRoute.php
 * 
 * @author SuperSpyTX
 */

class JokesRoute implements \Supah_Framework\routing\IRoute {
	private $uri, $module;

	public function __construct($uri, $module) {
		$this->uri = $uri;
		$this->module = $module;
	}

	public function route($uri) {
		$config = $this->module->getConfiguration();
		$controller = null;
		if ($config->isKeySet("smallpenis.custominput") && $config->isKeySet("madbros.custominput")) {
			$controller = new JokesController($uri, array("smallpenises" => $config->getValue("smallpenis.custominput"), "madbros" => $config->getValue("madbros.custominput")));
		} else {
			$controller = new JokesController($uri, $this->parseArrays($uri));
		}
		$controller->exec();
	}

	private function parseArrays($uri) {
		$smallpenises = array();
		$madbros = array();
		$currentArray = $smallpenises;
		foreach($uri as $key => $value) {
			if ($value == "madbros") {
				$smallpenises = $currentArray;
				$currentArray = $madbros;
				continue;
			}
			$currentArray[] = urldecode($value);
		}

		$madbros = $currentArray;

		return array("smallpenises" => implode(",", $smallpenises), "madbros" => implode(",", $madbros));
	}

	public function ruleMatches($uri) {
		return true;
	}
}