<?php
/**
 * Created by PhpStorm.
 * User: Joe
 * Date: 11/12/2014
 * Time: 12:22 PM
 */

namespace Supah_Framework\Config;


class Configuration {

    public function __construct($file) {
        include $file.".php";
        if (!isset($CFG)) {
            return;
        }
        foreach ($CFG as $k => $v) {
            $this->$k = $v;
        }
    }
}