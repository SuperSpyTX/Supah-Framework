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

		if ($system->getDatabase()->isEnabled()) {
			$toAdd = "<br><br>Time for a database test!<br><br>";
			$list = $system->getDatabase()->select("*", "mypix_luv", array("gay" => "no"));
			print_r($list);
			$toAdd .= \Supah_Framework\utilities\GenerationUtility::generateList($list);
			$defaultContent->addEntry("dbTest", $toAdd);
		}

		$mainPage->addEntry("content", $defaultContent->renderPage());
		$system->getTemplates()->printPage($mainPage);
	}
}