<?php
/**
 * Created by PhpStorm.
 * User: Joe
 * Date: 11/11/2014
 * Time: 5:04 PM
 */

namespace Application\Controllers;

class Welcome {
    public function index($name) {
        $view = \View::create("welcome");

        $view->mymsg = \Dynconfig::app()->test;

        $view->wat = "--dnd";
        $view->wat->fuf = "FuuuF!";

        return $view;
    }
}