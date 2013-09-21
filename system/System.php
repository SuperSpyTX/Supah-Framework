<?php
/**
 * Class System.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

class System implements \Supah_Framework\application\IExecutable {
	private $base_application;
	private $routing;
	private $templates;

	function __construct($base_application_path) {
		if ($this->base_application == null) {
			require($base_application_path);
			$this->base_application = $application($this);
			$this->routing = new Routing($this);
			$this->templates = new Templates($this);

			foreach ($this->getApplication()->getModules() as $name => $class) {
				if ($class->isEnabled()) {
					// TODO: keep track of modules loaded.
					$class->exec();
				}
			}
		}
	}

	function exec() {
		$this->getRouting()->exec();
	}

	function getApplication() {
		return $this->base_application;
	}

	function getRouting() {
		return $this->routing;
	}

	function getTemplates() {
		return $this->templates;
	}
}