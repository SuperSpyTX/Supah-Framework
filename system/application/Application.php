<?php
/**
 * Class Application.php
 * 
 * @author SuperSpyTX
 */

namespace Supah_Framework\application;


interface Application {
	public function getName();

	public function getRoutes();
}