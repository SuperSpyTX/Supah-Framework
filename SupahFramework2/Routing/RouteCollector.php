<?php
/**
 * Created by PhpStorm.
 * User: Joe
 * Date: 6/5/2015
 * Time: 1:31 AM
 */

namespace SupahFramework2\Routing;

use \FastRoute\RouteParser;
use \FastRoute\DataGenerator;

// Copied from FastRoute to make few additions.

class RouteCollector {
    private $routeParser;
    private $dataGenerator;

    /**
     * Constructs a route collector.
     *
     * @param RouteParser   $routeParser
     * @param DataGenerator $dataGenerator
     */
    public function __construct(RouteParser $routeParser, DataGenerator $dataGenerator) {
        $this->routeParser = $routeParser;
        $this->dataGenerator = $dataGenerator;
    }

    /**
     * Adds a route to the collection.
     *
     * The syntax used in the $route string depends on the used route parser.
     *
     * @param string|string[] $httpMethod
     * @param string $route
     * @param mixed  $handler
     */
    public function addRoute($httpMethod, $route, $handler) {
        $routeData = $this->routeParser->parse($route);
        foreach ((array) $httpMethod as $method) {
            $this->dataGenerator->addRoute($method, $routeData, $handler);
        }
    }

    // TODO: add more error codes
    public function add404($handler) {
        $this->addErrorHandler('404', $handler);
    }

    public function add503($handler) {
        $this->addErrorHandler('503', $handler);
    }

    public function addErrorHandler($errorCode, $handler) {
        Router::addErrorHandler($errorCode, $handler);
    }

    /**
     * Returns the collected route data, as provided by the data generator.
     *
     * @return array
     */
    public function getData() {
        return $this->dataGenerator->getData();
    }
}