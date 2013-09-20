<?php
/**
 * Class JokesController.php
 * 
 * @author SuperSpyTX
 */

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

class JokesController implements \Supah_Framework\application\IController {
	private $uri;
	private $args;

	function __construct($uri, $args) {
		$this->uri = $uri;
		$this->args = $args;
	}

	function exec() {
		global $system;
		// default page so not to fear with arguments.

		$mainPage = $system->getTemplates()->createPage("Jokes Page", "default");
		$content = $system->getTemplates()->createPage(null, "jokes/content");

		// Create small penis list.
		$smallpenis = $system->getTemplates()->createPage(null, "jokes/smallpenis");
		$penislist = \Supah_Framework\utilities\GenerationUtility::generateList(explode(",", $this->args["smallpenises"]));
		$smallpenis->addEntry("penislist", $penislist);
		$content->addEntry("smallpenis", $smallpenis->renderPage());

		// Create madbros list.
		$madbros = $system->getTemplates()->createPage(null, "jokes/madbros");
		$madbroslist = \Supah_Framework\utilities\GenerationUtility::generateList(explode(",", $this->args["madbros"]));
		$madbros->addEntry("madbrosList", $madbroslist);
		$content->addEntry("madbros", $madbros->renderPage());

		$mainPage->addEntry("content", $content->renderPage());
		$system->getTemplates()->printPage($mainPage);
	}
}