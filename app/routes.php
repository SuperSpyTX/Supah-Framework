<?php
/**
 * Created by PhpStorm.
 * User: Joe
 * Date: 11/11/2014
 * Time: 11:22 AM
 */

Routes::get('/sf2/', 'Welcome');

Routes::get('/sf2/penis/{penis}', function ($penis) {
    echo "Hello World! My penis size is: ".$penis;
});