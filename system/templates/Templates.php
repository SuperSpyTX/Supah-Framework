<?php
/**
 * Class Routing.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework;

use Supah_Framework\templates\Template;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

/**
 * Class Templates
 * The class that organizes your pages in your application.
 * This templates system is pretty old (March 2012), but the code was slightly rewritten for this framework.
 *
 * @package Supah_Framework
 */
class Templates {
	private $system;

	/**
	 * Constructs the Templates class.
	 *
	 * @param $system System
	 */
	function __construct($system) {
		$this->system = $system;
	}

	/**
	 * Loads a template.
	 * NOTE: The name of the script is relative to your application directory's "templates" folder.
	 * WARNING: DO NOT INCLUDE .TMPL AT THE END OF THE TEMPLATE NAME!!!
	 *
	 * @param $template_name string
	 * @param null $page_name string
	 * @return Template
	 */
	function load($template_name, $page_name = null) {
		return new Template($template_name, $page_name);
	}

	/**
	 * Executes the template and echos it to the page.
	 *
	 * @deprecated This is basically redundant, you should just use exec() and echo it yourself.  Is it that hard?
	 * @param $page
	 */
	function printPage($page) {
		echo($this->exec($page));
	}

	/**
	 * Executes the template with the passed Template class.
	 * Fun fact: This is the old part of the templates system.
	 *
	 * @param $page Template
	 * @return bool|string
	 */
	function exec($page) {
		//the magic of evolution :)

		if (!$page instanceof Template || !file_exists($page->getTemplatePath())) {
			//don't evaluate non-existent templates.
			return false;
		}

		$renderedPage = str_replace("\'", "'", addslashes(@file_get_contents($page->getTemplatePath())));

		extract($page->getEntries());

		eval("\$renderedPage = \"$renderedPage\";");

		return $renderedPage;
	}
}

?>