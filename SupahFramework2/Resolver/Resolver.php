<?php
/**
 * Created by PhpStorm.
 * User: Joe
 * Date: 6/4/2015
 * Time: 10:49 PM
 */

namespace SupahFramework2\Resolver;

class Resolver {
    private static $composerIndex = -1;
    private static $mappings = [], $namespaces = [];

    public static function __callStatic($method, $args) {
        if (isset(self::$mappings[$method])) {
            if (sizeof(array_filter($args)) > 0) {
                $resolveClass = new self::$mappings[$method]($args);
            } else {
                $resolveClass = new self::$mappings[$method]();
            }

            return $resolveClass;
        }

        foreach (self::$namespaces as $namespace) {
            if (class_exists($namespace . "\\" . ucfirst($method), true)) {
                self::$mappings[$method] = $namespace . "\\" . $method;

                return self::__callStatic($method, $args);
            }
        }

        $arr = self::getClasses();
        foreach ($arr as $class) {
            $idx = $class;
            if (strpos($class, "\\") !== false) {
                $idx = substr($class, strrpos($class, "\\") + 1);
            }
            if ($idx == ucfirst($method)) {
                self::$mappings[strtolower($idx)] = $class;

                return self::__callStatic($method, $args);
            }
        }

        return null;
    }

    private static function getClasses() {
        return array_slice(get_declared_classes(), self::$composerIndex + 1);
    }

    public static function hookFunction() {
        if (!function_exists('resolve')) {

            // Just don't ask why :P
            eval('function resolve($name) {$args = func_get_args();array_shift($args); return ' . get_class(new Resolver) . '::$name($args);}');
        }

        // get the index in get_declared_classes()
        if (self::$composerIndex == -1) {
            $arr = get_declared_classes();
            $prefix = "ComposerAutoloader";
            $i = 0;
            foreach ($arr as $className) {
                if (substr($className, 0, strlen($prefix)) == $prefix) {
                    self::$composerIndex = $i;
                    break;
                }
                $i++;
            }
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