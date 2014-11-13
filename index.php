<?php

include "bootstrap/boot.php";
include "app/routes.php";

//ob_start();

$view = Routes::route($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

echo $view;

//echo ob_get_contents();

//ob_end_flush();