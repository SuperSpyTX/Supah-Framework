<?php
/**
 * Class Template.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework\templates;

use Supah_Framework\application\IExecutable;
use Supah_Framework\utilities\GenerationUtility;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

/**
 * Class Template
 * The class that identifies a template that can be used as the entire page, or as a particular element for one.
 *
 * @package Supah_Framework\templates
 */
class Template implements IExecutable {
	private $pagevars, $template_name, $template_path;

	/**
	 * Constructs the Template class.
	 *
	 * @param $template_name string
	 * @param $page_title string|null
	 */
	function __construct($template_name, $page_title) {
		$this->template_name = $template_name;
		$this->template_path = APP_DIR . "templates/" . $template_name . ".tmpl";

		$this->setEntries(($page_title != null ? array('title' => GenerationUtility::generateTitle($page_title)) : array()));
	}

	/**
	 * Executes this template with the given variables.
	 *
	 * @return bool|string
	 */
	function exec() {
		global $system;

		return $system->getTemplates()->exec($this);
	}

	/**
	 * Such brilliance!
	 *
	 * @return bool|string
	 */
	function __toString() {
		return $this->exec(); // HOLY CRAP!!!
	}

	/**
	 * Adds multiple entries to this template.
	 * See @link #addEntry($key, $value)
	 *
	 * @param $array
	 */
	function addMultipleEntries($array) {
		$this->pagevars = array_merge($array, $this->pagevars);
	}

	/**
	 * Adds a variable entry to this template.
	 *
	 * @param $key
	 * @param $value
	 */
	function addEntry($key, $value) {
		$this->addMultipleEntries(array($key => $value));
	}

	/**
	 * Gets this template's entries.
	 *
	 * @return array
	 */
	function getEntries() {
		return $this->pagevars;
	}

	/**
	 * Sets an array to be all of this template's entries.
	 *
	 * @param $array
	 */
	function setEntries($array) {
		$this->pagevars = $array;
	}

	/**
	 * Gets this template's title.
	 * @deprecated This is meant to be this template's page title, not this template's title!
	 *
	 * @return string|null
	 */
	function getTitle() {
		return $this->pagevars['title'];
	}

	/**
	 * Gets this template's page title.
	 *
	 * @return string|null
	 */
	function getPageTitle() {
		return $this->pagevars['title'];
	}

	/**
	 * Gets this template's name.
	 *
	 * @return mixed
	 */
	function getTemplateName() {
		return $this->template_name;
	}

	/**
	 * Gets this template's file path.
	 *
	 * @return string
	 */
	function getTemplatePath() {
		return $this->template_path;
	}

	/**
	 * Gets this template's page variables.
	 * @deprecated Please use getEntries() as it has a consistent name.
	 *
	 * @return array
	 */
	function getPageVariables() {
		return $this->pagevars;
	}
}