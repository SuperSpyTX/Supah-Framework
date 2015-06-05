<?php
/**
 * Created by PhpStorm.
 * User: Joe
 * Date: 11/11/2014
 * Time: 11:15 AM
 */
define('APPLICATION_PATH', dirname(dirname(__FILE__)) . '/Application');
define('FRAMEWORK_PATH', dirname(dirname(__FILE__)) . '/SupahFramework2');

if (!file_exists("vendor/autoload.php")) {
    die("You need to run 'composer install' on the command-line to run Supah Framework 2.");
}

$loader = require("vendor/autoload.php");

$loader->setPsr4("Application\\", APPLICATION_PATH);
$loader->setPsr4("SupahFramework2\\", FRAMEWORK_PATH);

include_once("sf2.php");
include_once("app.php");