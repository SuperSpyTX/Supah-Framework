<?php
/**
 * Created by PhpStorm.
 * User: Joe
 * Date: 11/11/2014
 * Time: 11:15 AM
 */
include "autoload.php";
$autoload = new \Bootstrap\Autoload([
    'dirs' => [
        'Supah_Framework' => 'sf2',
        'Application' => 'app',
        'Bootstrap' => 'bootstrap'
    ],
    'facadeDirs' => [
        'app/facades',
        'sf2/facades'
    ]
]);
$config = new \Supah_Framework\Config\Multi_Configuration();

$config->attach("sf2/config/sf2");
$config->attach("app/config/app");
$config->attach("app/config/sf2");