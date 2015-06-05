<?php
/**
 * Created by PhpStorm.
 * User: Joe
 * Date: 11/11/2014
 * Time: 11:22 AM
 */

return function (\SupahFramework2\Routing\RouteCollector $r) {
    $r->addRoute('GET', '/test', 'Welcome@index2');
    $r->add404(function () {
            echo("hai!!!");
        });
};