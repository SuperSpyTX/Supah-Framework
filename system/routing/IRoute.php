<?php
/**
 * Class IRoute.php
 *
 * @author SuperSpyTX
 */

namespace Supah_Framework\routing;

if (!defined("SF_INIT")) {
	die("SF_INIT not detected.");
}

interface IRoute {
	public function __construct($uri);

	public function route($uri);

	public function ruleMatches($uri);
}