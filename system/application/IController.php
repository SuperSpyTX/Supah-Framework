<?php
/**
 * Class IController.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework\application;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

interface IController {
	function __construct($uri, $args);

	function exec();
}