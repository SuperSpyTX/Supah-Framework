<?php
/**
 * Class Routing.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

class Templates {
	private $system;

	function __construct($system) {
		$this->system = $system;
	}

	function createPage($page_name, $template_name) {
		return new \Supah_Framework\templates\Page($page_name, $template_name);
	}

	function printPage($page) {
		echo($this->renderPage($page));
	}

	function renderPage($page) {
		//the magic of evolution :)

		if (!file_exists($page->getTemplatePath())) {
			//don't evaluate not existent templates.
			return false;
		}

		$renderedPage = @file_get_contents($page->getTemplatePath());

		extract($page->getPageVariables());

		eval("\$renderedPage = \"$renderedPage\";");

		return $renderedPage;
	}
}

?>