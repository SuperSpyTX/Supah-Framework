<?php
/**
 * Class IApplication.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

interface IApplication {
	public function getName();

	public function getRoutes();
}