<?php
/**
 * Created by PhpStorm.
 * User: Joe
 * Date: 6/5/2015
 * Time: 1:09 AM
 */

namespace SupahFramework2\Routing;

class Router {
    private static $dispatcher;
    private static $errorHandlers = [];

    public static function dispatch($httpMethod, $httpURI) {
        $baseURI = resolve('configuration')->sf2()->routing['base_uri'];
        $httpURI = parse_url($httpURI)['path'];
        if (substr($baseURI, strlen($baseURI) - 1) == '/') {
            $baseURI = substr($baseURI, 0, strlen($baseURI) - 1);
        }
        if ($baseURI != '/') {
            $httpURI = str_replace($baseURI, "", $httpURI);
        }

        $routeInfo = self::$dispatcher->dispatch($httpMethod, $httpURI);
        $results = null;
        switch ($routeInfo[0]) {
            case \FastRoute\Dispatcher::FOUND:
                $route = new DefinedRoute($routeInfo);
                $results = $route->dispatch();
                break;
            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $results = self::handleError('403');
                break;
            case \FastRoute\Dispatcher::NOT_FOUND:
                // 404!
                $results = self::handleError('404');
                break;
        }

        // Just hope you have a castable object!
        // TODO: maybe dynamically parse it or some shit?
        // TODO: Add ob flushing support.
        // TODO: Create a response object that'll dictate how the output should be printed to browser.
        if ($results instanceof ResponseObject) {
            // TODO: do some actual parsing.
            echo $results->content;
        } else if ($results != null) {
            echo $results;
        }
    }

    public static function collect($funcCallback) {
        if (self::$dispatcher == null) {
            self::$dispatcher = \FastRoute\simpleDispatcher($funcCallback, ['routeCollector' => 'SupahFramework2\\Routing\\RouteCollector']);
        }
    }

    public static function addErrorHandler($errorCode, $handler) {
        self::$errorHandlers[$errorCode] = $handler;
    }

    private static function handleError($errorCode) {
        if (isset(self::$errorHandlers[$errorCode])) {
            return self::callHandler(self::$errorHandlers[$errorCode], []);
        } else {
            // TODO: nice pages.
            return ("Error page but no error handler was available!");
        }
    }

    private static function callHandler($handler, $data) {
        return $handler($data);
    }
}