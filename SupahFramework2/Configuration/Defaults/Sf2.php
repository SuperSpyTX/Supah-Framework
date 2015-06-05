<?php
/**
 * Created by PhpStorm.
 * User: Joe
 * Date: 11/12/2014
 * Time: 9:53 PM
 */

/* SF2 Main Settings (please note, make overrides in sf2.php in the app folder! */

// Views
$CFG['views']['shortcut_create'] = "./";
$CFG['views']['auto_shortcut_create'] = true;

// Doctrine boot
$CFG['doctrine']['enabled'] = false;
$CFG['doctrine']['devmode'] = true;
$CFG['doctrine']['connection'] = array(
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/db.sqlite',
);