<?php

include "bootstrap/boot.php";

//resolve('router')->dispatch('GET', '/test');

resolve('router')->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
