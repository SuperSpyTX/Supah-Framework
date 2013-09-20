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

		$mainPage = $system->getTemplates()->createPage("Error Page - " . $this->args['error'], "default");
		$errorCode = substr($this->args['error'], 0, 3);
		$errorPage = $system->getTemplates()->createPage(null, "errors/" . $errorCode);
		$mainPage->addEntry("content", $errorPage->renderPage());
		$system->getTemplates()->printPage($mainPage);
	}
}