<?php
if (!defined("SF_INIT")) {
	echo("PHP_SECURITY_VIOLATION");
	exit;
}

// TODO: Redo this entire class.
class Templates {
	var $template_name;
	var $system;

	function __construct($instance) {
		$this->system = $instance;
	}

	function load_tmpl($tmpname) {
		$this->templname = $tmpname;
	}

	function eval_page($pagevars) {
		//the magic of evolution :)

		if (!file_exists(ADMIN_DIR . "templates/" . $this->templname . ".tmpl")) {
			//don't evaluate non-existing pages.
			return;
		}

		$page = @file_get_contents(ADMIN_DIR . "templates/" . $this->templname . ".tmpl");

		extract($pagevars);

		eval("\$page = \"$page\";");
		echo($page);

	}

	function get_tmpl_page($tmplname, $pagevars = array()) {
		//the magic of evolution :)

		if (!file_exists(ADMIN_DIR . "templates/" . $tmplname . ".tmpl")) {
			//don't evaluate not existent pages.
			return;
		}

		$page = @file_get_contents(ADMIN_DIR . "templates/" . $tmplname . ".tmpl");

		extract($pagevars);

		eval("\$page = \"$page\";");

		return $page;

	}

	function add_var($variable, $value, $pagevars) {
		$toadd = array($variable => $value);

		return array_merge($pagevars, $toadd);
	}

	function add_multi_var($arraytoadd, $pagevars) {
		return array_merge($pagevars, $arraytoadd);
	}

	function generate_link($script, $comment, $sizeup = false) {
		return "<a href=\"" . $script . "\">" . $comment . "</a>";
	}
}

?>