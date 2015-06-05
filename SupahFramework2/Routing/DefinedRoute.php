<?php
/**
 * Created by PhpStorm.
 * User: Joe
 * Date: 6/5/2015
 * Time: 1:51 AM
 */

namespace SupahFramework2\Routing;

class DefinedRoute {
    private $handler, $method, $data;

    public function __construct(&$routeInfoArr) {
        $this->handler = $routeInfoArr[1];
        $this->method = $routeInfoArr[0];
        $this->data = $routeInfoArr[2];
    }

    public function dispatch() {
        if (is_callable($this->handler)) {
            $handler = $this->handler;
            return $handler($this->data);
        } else {
            // Resolve namespace & dependency injection & everything as always.
            if (strpos($this->handler, "@") !== false) {
                $spl = explode("@", $this->handler);
                $className = 'Application\\Web\\Handlers\\' . $spl[0];
                $methodName = $spl[1];
            } else {
                $className = 'Application\\Web\\Handlers\\' . $this->handler;
                $methodName = "index";
            }

            $controller = new \ReflectionClass($className);
            $cArgs = [];
            $controllerI = null;
            if (null !== $controller->getConstructor()) {
                foreach ($controller->getConstructor()->getParameters() as $param) {
                    $cArgs[] = $param->getDeclaringClass()->newInstanceWithoutConstructor();
                }
            }

            $controller = new $className($cArgs);
            return $controller->$methodName($this->data);
        }
    }
}