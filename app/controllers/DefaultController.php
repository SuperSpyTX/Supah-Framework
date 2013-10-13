<?php
/**
 * Class DefaultController.php
 *
 * @author SuperSpyTX
 */

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

class DefaultController implements Supah_Framework\application\IController {
	private $module, $uri, $args;

	function __construct($module, $uri, $args) {
		$this->module = $module;
		$this->uri = $uri;
		$this->args = $args;
	}

	function exec() {
		global $system;
		// default page so not to fear with arguments.

		$mainPage = $system->getTemplates()->load("default", $system->getApplication()->getTitle());
		$defaultContent = $system->getTemplates()->load("default_welcome_message");

		$mainPage->addEntry("content", $defaultContent->exec());
		echo($mainPage);
	}
}