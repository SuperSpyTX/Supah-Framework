<?php
/**
 * Created by PhpStorm.
 * User: Joe
 * Date: 11/12/2014
 * Time: 11:23 PM
 */

namespace Supah_Framework\Config;

class Dynamic_Configuration {
    public static function __callStatic($name, $args) {
        if (file_exists("app/config/" . $name . ".php") && file_exists("sf2/config/" . $name . ".php")) {
            // merge two.
            $cfg = new Configuration("sf2/config/" . $name );
            $cfgApp = new Configuration("app/config/" . $name );

            $rfc = new \ReflectionObject($cfgApp);
            foreach ($rfc->getProperties() as $property) {
                $name = $property->getName();
                $value = $property->getValue($cfgApp);
                $cfg->$name = array_replace_recursive($cfg->$name, $value);
            }

            return $cfg;

        } else if (file_exists("app/config/" . $name . ".php")) {
            // load
            return new Configuration("app/config/" . $name );
        } else if (file_exists("sf2/config/" . $name . ".php")) {
            // load
            return new Configuration("sf2/config/" . $name );
        }/* // This would be too dangerous, since this is already dangerous in itself!
          else if (!empty($args) && is_string($args)) {
            return new Configuration($args);
        }*/
    }
} 