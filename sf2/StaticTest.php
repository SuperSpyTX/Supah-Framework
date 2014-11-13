<?php
/**
 * Created by PhpStorm.
 * User: Joe
 * Date: 11/12/2014
 * Time: 1:39 PM
 */

namespace Supah_Framework;


class StaticTest {
    public $var = "changeme";

    public function meh() {
        echo $this->var;
    }
} 