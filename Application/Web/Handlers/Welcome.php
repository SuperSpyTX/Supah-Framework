<?php
/**
 * Created by PhpStorm.
 * User: Joe
 * Date: 11/11/2014
 * Time: 5:04 PM
 */

namespace Application\Web\Handlers;


class Welcome {
    public function index2($name) {
        $view = resolve('view')->create("welcome");

        $view->mymsg = resolve('configuration')->app()->test;

        return $view;
    }
}