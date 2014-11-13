<?php
/**
 * Created by PhpStorm.
 * User: Joe
 * Date: 11/11/2014
 * Time: 2:42 PM
 */

namespace Supah_Framework\Requests;


class Uri {

    function __construct($uri) {
        $this->uri = $uri['uri'];
        $this->chunks = $uri['array'];
        foreach ($uri['parts'] as $part => $value) {
            if (!is_numeric($part)) {
                $this->$part = $value;
            }
        }
    }

    function __toString() {
        return $this->uri;
    }
} 