<?php
/**
 * Created by PhpStorm.
 * User: Joe
 * Date: 11/12/2014
 * Time: 12:22 PM
 */

namespace Supah_Framework\Config;


class Multiconfiguration {

    public function __construct() {
    }

    public function attach($file) {
        $this->attachWithAlias($file, null);
    }

    public function attachWithAlias($file, $alias) {
        if (!isset($alias)) {
            $alias = pathinfo($file, PATHINFO_FILENAME);
        }
        $this->$alias = new Configuration($file);
    }
}