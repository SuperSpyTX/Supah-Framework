<?php
/**
 * Created by PhpStorm.
 * User: Joe
 * Date: 11/12/2014
 * Time: 12:22 PM
 */

namespace Supah_Framework\Config;

class Multi_Configuration {
    public function attach($file) {
        $this->attachWithAlias($file, null);
    }

    public function attachWithAlias($file, $alias) {
        if (!isset($alias)) {
            $alias = pathinfo($file, PATHINFO_FILENAME);
        }
        if (isset($this->$alias)) {
            $newConfig = new Configuration($file);

            $rfc = new \ReflectionObject($newConfig);
            foreach ($rfc->getProperties() as $property) {
                $name = $property->getName();
                $value = $property->getValue($newConfig);
                $this->$alias->$name = array_replace_recursive($this->$alias->$name, $value);
            }
        } else {
            $this->$alias = new Configuration($file);
        }
    }
}