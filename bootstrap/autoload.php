<?php
/**
 * Created by PhpStorm.
 * User: Joe
 * Date: 11/11/2014
 * Time: 10:43 AM
 */

namespace Bootstrap;

class Autoload {
    private $dirs;
    private $facadeDirs;

    function __construct($arr) {
        spl_autoload_register(array(
                $this,
                'load'
            ));
        $this->dirs = $arr['dirs'];
        $this->facadeDirs = $arr['facadeDirs'];
    }

    private function fixPath($class) {
        $path = strtolower($class);
        $path = str_replace(pathinfo($path, PATHINFO_FILENAME), ucfirst(pathinfo($path, PATHINFO_FILENAME)), $path);
        return $path;
    }

    function load($class) {
        $dirPrefix = "vendor";
        $match = false;

        foreach ($this->facadeDirs as $dir) {
            if (file_exists($dir."/".$this->fixPath($class).".php") || file_exists($dir."/".strtolower($class).".php")) {
                $dirPrefix = $dir."/";
                $match = true;
            }
        }

        if (!$match) {
            foreach ($this->dirs as $package => $path) {
                if (stripos($class, $package) !== false) {
                    $dirPrefix = $path;
                    $class = substr($class, strlen($package));
                    break;
                }
            }
        }

        if (file_exists($dirPrefix . $this->fixPath($class) . ".php")) {
            require_once $dirPrefix . $this->fixPath($class) . ".php";
        } else if (file_exists($dirPrefix . strtolower($class) . ".php")) {
            require_once $dirPrefix . strtolower($class) . ".php";
        }
    }
}