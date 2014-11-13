<?php
/**
 * Created by PhpStorm.
 * User: Joe
 * Date: 11/11/2014
 * Time: 11:27 AM
 */

namespace Supah_Framework\Requests;

class Routes {
    static private $routes = [];

    // TODO: More HTTP methods.
    static function get($uri, $arrayfunc) {
        Routes::set($uri, $arrayfunc, __FUNCTION__);
    }

    static function post($uri, $arrayfunc) {
        Routes::set($uri, $arrayfunc, __FUNCTION__);
    }

    private static function set($uri, $arrayfunc, $type) {
        if (!is_array($arrayfunc) && !is_string($arrayfunc)) {
            $arr = [];
            $arr['uri'] = $uri;
            $arr['function'] = $arrayfunc;
            $arr['request'] = $type;
            Routes::$routes[$uri] = $arr;
        } else if (is_string($arrayfunc)) {
            $arr = [];
            $arr['uri'] = $uri;
            $arr['controller'] = $arrayfunc;
            $arr['request'] = $type;
            Routes::$routes[$uri] = $arr;
        } else {
            Routes::$routes[$uri] = $arrayfunc;
        }
    }

    private static function parse($uri) {
        $arr = [];
        $urispl = explode("/", $uri);
        $i = 0;
        foreach ($urispl as $piece) {
            if (stripos(substr($piece, 0, 1), "{") !== false) {
                $arr['parts'][substr($piece, 1, strlen($piece) - 2)] = null;
            }
            $i++;
        }

        if (!empty($arr)) {
            $arr['uri'] = $uri;
            $arr['array'] = $urispl;

            return $arr;
        } else {
            return $uri;
        }
    }

    private static function fill($uriArr, $uri, $type) {
        $uriFill = explode("/", $uri);
        $arr = [];

        if ((isset($uriArr['request']) ? $uriArr['request'] == $type : true) && sizeof($uriArr['array']) == sizeof($uriFill) && substr($uriArr['uri'], 0, stripos($uriArr['uri'], "{")) == substr($uri, 0, stripos($uriArr['uri'], "{"))) {
            $i = 0;
            foreach ($uriArr['array'] as $uriPart) {
                if (stripos(substr($uriPart, 0, 1), "{") !== false) {
                    $arr[substr($uriPart, 1, strlen($uriPart) - 2)] = $uriFill[$i];
                    $arr[$i] = $uriFill[$i];
                }
                $i++;
            }

            return $arr;
        }

        return false;
    }

    static function route($uri, $type) {
        foreach (Routes::$routes as $route => $arr) {
            $args = "";
            $uriparse = Routes::parse($arr['uri']);
            if (is_array($uriparse)) {
                // fun!
                $filled = Routes::fill($uriparse, $uri, $type);
                if (!$filled) {
                    continue;
                }

                $args = $filled;
            } else if ($uri == $arr['uri']) {
                $args = $uri;
            }

            if (!empty($args)) {
                if (isset($arr['controller'])) {
                    $split = explode("@", $arr['controller']);
                    if (!isset($split[1])) {
                        $split[1] = "index";
                    }

                    $controller = new \ReflectionClass('Application\Controllers\\' . $split[0]);
                    $cArgs = [];
                    $controllerI = null;
                    if (null !== $controller->getConstructor()) {
                        foreach ($controller->getConstructor()->getParameters() as $param) {
                            $cArgs[] = $param->getDeclaringClass()->newInstanceWithoutConstructor();
                        }

                        $controllerI = $controller->newInstanceArgs($cArgs);
                    } else {
                        $controllerI = $controller->newInstance();
                    }

                    if (is_array($args)) {
                        $rm = $controller->getMethod($split[1]);
                        $mArgs = [];
                        $mSize = sizeof($rm->getParameters());
                        foreach ($args as $name => $value) {
                            if (sizeof($mArgs) >= $mSize) {
                                break;
                            }
                            if (is_numeric($name)) {
                                $mArgs[] = $value;
                            }
                        }

                        return $rm->invokeArgs($controllerI, $mArgs);
                    } else {
                        return $controllerI->$split[1]($args);
                    }
                } else {
                    if (is_array($args)) {
                        $rf = new \ReflectionFunction($arr['function']);
                        $fArgs = [];
                        $fSize = sizeof($rf->getParameters());
                        foreach ($args as $name => $value) {
                            if (sizeof($fArgs) >= $fSize) {
                                break;
                            }
                            if (is_numeric($name)) {
                                $fArgs[] = $value;
                            }
                        }

                        return $rf->invokeArgs($fArgs);
                    }
                    return $arr['function']($args);
                }
            }
        }
    }
}