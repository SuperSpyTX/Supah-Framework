<?php
/**
 * Class Routing.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework;


class Templates {
	private $system;

	function __construct($system) {
		$this->system = $system;
	}

	function loadTemplate($tmpname) {
		return array('template_name' => $tmpname);
	}

	function evaluate($pagevars) {
		echo($this->getEvaluatedPage($pagevars));
	}

	function getEvaluatedPage($pagevars = array()) {
		//the magic of evolution :)

		if (!file_exists(APP_DIR . "templates/" . $pagevars['template_name'] . ".tmpl")) {
			//don't evaluate not existent pages.
			return;
		}
		$page = @file_get_contents(APP_DIR . "templates/" . $pagevars['template_name'] . ".tmpl");

		extract($pagevars);

		eval("\$page = \"$page\";");

		return $page;
	}

	function add_var($variable, $value, $pagevars) {
		return $this->add_multi_var(array($variable => $value), $pagevars);
	}

	function add_multi_var($arraytoadd, $pagevars) {
		return array_merge($pagevars, $arraytoadd);
	}

	// TODO: delegate to Template Utilities.
	function generate_link($script, $comment, $sizeup = false) {
		return "<a href=\"" . $script . "\">" . $comment . "</a>";
	}
}

?>