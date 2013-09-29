<?php
/**
 * Class ErrorController.php
 *
 * @author SuperSpyTX
 */

class ErrorController implements \Supah_Framework\application\IController {
	private $uri, $args;

	function __construct($uri, $args) {
		$this->uri = $uri;
		$this->args = $args;
	}

	function exec() {
		global $system;

		$errorCode = substr($this->args['error'], 0, 3);
		$mainPage = $system->getTemplates()->load("default", "Error Page - " . $errorCode);
		$errorPage = $system->getTemplates()->load("errors/" . $errorCode);
		$mainPage->addEntry("content", $errorPage->renderPage());
		$system->getTemplates()->printPage($mainPage);
	}
}