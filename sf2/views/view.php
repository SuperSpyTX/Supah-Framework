<?php
/**
 * Created by PhpStorm.
 * User: Joe
 * Date: 11/12/2014
 * Time: 12:36 AM
 */

namespace Supah_Framework\Views;

class View {
    private $templateName = "";

    public static function create($templateName) {
        //        echo($templateName);
        $view = new View();
        $view->templateName = $templateName;

        return $view;
    }

    public function output($return) {
        $rfc = new \ReflectionObject($this);
        $vars = [];
        foreach ($rfc->getProperties() as $property) {
            if ($property->name != "templateName") {
                $name = $property->getName();
                $value = $property->getValue($this);
                $vars[$name] = $value;
            }
        }

        ob_start();
        extract($vars);
        include("app/views/" . $this->templateName . ".php");
        $str = ob_get_clean();

        if (!$return) {
            echo $str;
        } else {
            return $str;
        }
    }

    public function __get($name) {
        if (!isset($this->$name)) {
            return $this::create($name);
        }

        return $this->$name;
    }

    public function __set($name, $value) {
        if (isset($this->$name) && is_string($this->$name)) {
            // holy shit magic!
            $origVal = $this->$name;
            $this->$name = $this::create($origVal);
            foreach ($value as $k => $v) {
                $this->$name->$k = $v;
            }
        } else {
            $this->$name = $value;
        }
//        $this->$name = $value;
    }

    public function __toString() {
        return $this->output(true);
    }
} 