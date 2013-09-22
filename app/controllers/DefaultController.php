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
	private $uri, $args;

	function __construct($uri, $args) {
		$this->uri = $uri;
		$this->args = $args;
	}

	function exec() {
		global $system;
		// default page so not to fear with arguments.

		$mainPage = $system->getTemplates()->createPage("Default Page", "default");
		$defaultContent = $system->getTemplates()->createPage(null, "default_welcome_message");

		if ($system->isModuleLoaded("jokes")) {
			$toAdd = "<br><br>".PHP_EOL."You should also ".\Supah_Framework\utilities\GenerationUtility::generateLink(BASE_URI . "jokes", "check this out!")." It's lulzy.";
			$defaultContent->addEntry("jokesReferral", $toAdd);
		}
		$mainPage->addEntry("content", $defaultContent->renderPage());
		$system->getTemplates()->printPage($mainPage);
	}
}