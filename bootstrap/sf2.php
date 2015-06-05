<?php
/**
 * Created by PhpStorm.
 * User: Joe
 * Date: 6/5/2015
 * Time: 3:53 PM
 */

use \SupahFramework2\Resolver\Resolver;

Resolver::hookFunction();
Resolver::loadPrefixes($loader->getPrefixes());

foreach ($loader->getPrefixesPsr4() as $namespace => $dir) {
    if ($namespace != null) {
        Resolver::loadNamespace($namespace);
    }
}

Resolver::loadNamespace("SupahFramework2\\Configuration");
Resolver::loadNamespace("SupahFramework2\\Resolver");
Resolver::loadNamespace("SupahFramework2\\Routing");
Resolver::loadNamespace("SupahFramework2\\Views");
Resolver::loadNamespace("SupahFramework2\\Wrappers");
