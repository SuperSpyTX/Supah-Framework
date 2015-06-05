<?php
/**
 * Created by PhpStorm.
 * User: Joe
 * Date: 11/12/2014
 * Time: 11:23 PM
 */

namespace SupahFramework2\Configuration;

class Configuration {
    private static $cached = [];

    public function __call($name, $args) {
        return self::__callStatic($name, $args);
    }

    public static function __callStatic($name, $args) {
        if (isset(self::$cached[$name])) {
            return self::$cached[$name];
        }
        if (file_exists(APPLICATION_PATH."/Configuration/" . ucfirst($name) . ".php") && file_exists(FRAMEWORK_PATH."/Configuration/Defaults/" . ucfirst($name) . ".php")) {
            // merge two.
            $name = ucfirst($name);
            $cfgApp = new StandardConfigurationFile(APPLICATION_PATH."/Configuration/" . $name );
            $cfg = new StandardConfigurationFile(FRAMEWORK_PATH."/Configuration/Defaults/" . $name );

            $rfc = new \ReflectionObject($cfgApp);
            foreach ($rfc->getProperties() as $property) {
                $name = $property->getName();
                $value = $property->getValue($cfgApp);
                $cfg->$name = array_replace_recursive($cfg->$name, $value);
            }

            self::$cached[$name] = $cfg;

            return $cfg;

        } else if (file_exists(APPLICATION_PATH."/Configuration/" . ucfirst($name) . ".php")) {
            // load
            $name = ucfirst($name);
            $newcfg = new StandardConfigurationFile(APPLICATION_PATH."/Configuration/" . $name );
            self::$cached[$name] = $newcfg;
            return $newcfg;
        } else if (file_exists(FRAMEWORK_PATH."/Configuration/Defaults/" . ucfirst($name) . ".php")) {
            // load
            $name = ucfirst($name);
            $newcfg = new StandardConfigurationFile(FRAMEWORK_PATH."/Configuration/Defaults/" . $name );
            self::$cached[$name] = $newcfg;
            return $newcfg;
        }/* // This would be too dangerous, since this is already dangerous in itself!
          else if (!empty($args) && is_string($args)) {
            return new Configuration($args);
        }*/
    }
} 