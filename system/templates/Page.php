<?php
/**
 * Class Page.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework\templates;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

class Page implements \Supah_Framework\application\IExecutable {
	private $pagevars;
	private $template_name;
	private $template_path;

	function __construct($template_name, $page_title) {
		$this->template_name = $template_name;
		$this->template_path = APP_DIR . "templates/" . $template_name . ".tmpl";

		$this->setEntries(($page_title != null ? array('title' => \Supah_Framework\utilities\GenerationUtility::generateTitle($page_title)) : array()));
	}

	function addMultipleEntries($array) {
		$this->pagevars = array_merge($array, $this->pagevars);
	}

	function addEntry($key, $value) {
		$this->addMultipleEntries(array($key => $value));
	}

	function setEntries($array) {
		$this->pagevars = $array;
	}

	function getTitle() {
		return $this->pagevars['title'];
	}

	function getTemplateName() {
		return $this->template_name;
	}

	function getTemplatePath() {
		return $this->template_path;
	}

	function getPageVariables() {
		return $this->pagevars;
	}

	function exec() {
		global $system;

		return $system->getTemplates()->exec($this);
	}
}