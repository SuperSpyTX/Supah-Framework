<?php
/**
 * Class Routing.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework;

use Supah_Framework\templates\Page;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

class Templates {
	private $system;

	function __construct($system) {
		$this->system = $system;
	}

	function load($template_name, $page_name = null) {
		return new Page($template_name, $page_name);
	}

	function printPage($page) {
		echo($this->exec($page));
	}

	function exec($page) {
		//the magic of evolution :)

		if (!$page instanceof Page || !file_exists($page->getTemplatePath())) {
			//don't evaluate non-existent templates.
			return false;
		}

		$renderedPage = str_replace("\'", "'", addslashes(@file_get_contents($page->getTemplatePath())));

		extract($page->getPageVariables());

		eval("\$renderedPage = \"$renderedPage\";");

		return $renderedPage;
	}
}

?>