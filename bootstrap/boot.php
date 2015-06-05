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

\SupahFramework2\Resolver\Resolver::hookFunction();
\SupahFramework2\Resolver\Resolver::loadPrefixes($loader->getPrefixes());

foreach ($loader->getPrefixesPsr4() as $namespace => $dir) {
    if ($namespace != null) {
        \SupahFramework2\Resolver\Resolver::loadNamespace($namespace);
    }
}

\SupahFramework2\Resolver\Resolver::loadNamespace("SupahFramework2\\Configuration");
\SupahFramework2\Resolver\Resolver::loadNamespace("SupahFramework2\\Resolver");
\SupahFramework2\Resolver\Resolver::loadNamespace("SupahFramework2\\Routing");
\SupahFramework2\Resolver\Resolver::loadNamespace("SupahFramework2\\Views");
\SupahFramework2\Resolver\Resolver::loadNamespace("SupahFramework2\\Wrappers");

resolve('router')->collect(require_once(APPLICATION_PATH.'/Routes.php'));

if (resolve('configuration')->sf2()->doctrine['enabled']) {
    include_once('doctrine_boot.php');
}