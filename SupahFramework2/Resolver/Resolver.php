<?php
/**
 * Created by PhpStorm.
 * User: Joe
 * Date: 6/4/2015
 * Time: 10:49 PM
 */

namespace SupahFramework2\Resolver;

class Resolver {
    private static $mappings = [], $namespaces = [];

    public static function __callStatic($method, $args) {
        if (isset(self::$mappings[$method])) {
            $resolveClass = new self::$mappings[$method]($args);

            return $resolveClass;
        }

        foreach (self::$namespaces as $namespace) {
            if (class_exists($namespace . "\\" . ucfirst($method), true)) {
                self::$mappings[$method] = $namespace . "\\" . $method;

                // Not a huge fan of this atm.
                /*
  if (!defined("PERFORMANCE_MODE")) {
                    $class = $namespace . "\\" . $method;
                    if (strpos($method, "\\") !== false) {
                        $index = strrpos($method, "\\");
                        $method = substr($method, $index + 1);
                        $method = strtolower($method);
                    }

                    self::$mappings[$method] = $class;
                }*/

                return self::__callStatic($method, $args);

            }
        }

        return null;
    }

    public static function hookFunction() {
        if (!function_exists('resolve')) {

            // Just don't ask why :P
            eval('function resolve($name) {$args = func_get_args();array_shift($args); return ' . get_class(new Resolver) . '::$name($args);}');
        }
    }

    public static function loadMap($name, $class) {
        self::$mappings[$name] = $class;
    }

    public static function loadNamespace($namespace) {
        self::$namespaces[] = $namespace;
    }

    public static function loadPrefixes(&$prefixes) {
        foreach ($prefixes as $prefix => $val) {
            self::$mappings[strtolower($prefix)] = $prefix;
        }
    }
}