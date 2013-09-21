<?php
/**
 * Class Application.php
 *
 * @author SuperSpyTX
 */

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

class DemoApplication implements Supah_Framework\application\IApplication {
	private $system;

	function __construct($system) {
		$this->system = $system;
	}

	public function getSystem() {
		return $this->system;
	}

	public function getName() {
		return "Demo Application";
	}

	public function getModules() {
		return array('default' => new DefaultModule($this), 'jokes' => new JokesModule($this));
	}
}