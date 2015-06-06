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
        if (is_callable($this->handler) && !is_array($this->handler)) {
            $handler = $this->handler;

            return $handler($this->data);
        } else if (is_string($this->handler) || is_array($this->handler)) {
            $interceptor = [];
            $handler = $this->handler;
            if (is_array($this->handler)) {
                if (!isset($this->handler['handler'])) {
                    throw new \ErrorException("No handler defined in array!");
                }

                $handler = $this->handler['handler'];

                if (isset($this->handler['interceptor'])) {
                    if (is_array($this->handler['interceptor'])) {
                        foreach ($this->handler['interceptor'] as $interceptor) {
                            $interceptor = 'Application\\Web\\Interceptors\\' . $interceptor;
                            $interceptor[] = new $interceptor();
                        }
                    } else {
                        // Of course! Dependency Injection & Initiation! (disabled for now)
                        $interceptor = 'Application\\Web\\Interceptors\\' . $this->handler['interceptor'];
                        /*$interceptController = new \ReflectionClass($interceptor);
                        $cArgs = [];
                        $controllerI = null;
                        if (null !== $interceptController->getConstructor()) {
                            foreach ($interceptController->getConstructor()->getParameters() as $param) {
                                $cArgs[] = $param->getDeclaringClass()->newInstanceWithoutConstructor();
                            }
                        }*/

                        $interceptor[] = new $interceptor();
                    }
                }
            }

            // Resolve namespace & dependency injection & everything as always.
            if (strpos($handler, "@") !== false) {
                $spl = explode("@", $handler);
                $className = 'Application\\Web\\Handlers\\' . $spl[0];
                $methodName = $spl[1];
            } else {
                $className = 'Application\\Web\\Handlers\\' . $handler;
                $methodName = "index";
            }

            $handleController = new \ReflectionClass($className);
            $cArgs = [];
            $controllerI = null;
            if (null !== $handleController->getConstructor()) {
                foreach ($handleController->getConstructor()->getParameters() as $param) {
                    $cArgs[] = $param->getDeclaringClass()->newInstanceWithoutConstructor();
                }
            }

            $handleController = new $className($cArgs);

            foreach ($interceptor as $interceptInstance) {
                if (method_exists($interceptInstance, "before")) {
                    $result = $interceptInstance->before();
                    if ($result != null) {
                        return $result;
                    }
                }
            }

            $response = $handleController->$methodName($this->data);

            foreach ($interceptor as $interceptInstance) {
                if (method_exists($interceptInstance, "after")) {
                    $result = $interceptInstance->after($response);
                    if ($result != null) {
                        $response = $result;
                    }
                }
            }

            return $response;
        }
    }
}