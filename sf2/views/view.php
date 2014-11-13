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
    private $disableShortcut = false;

    public static function create($templateName) {
        //        echo($templateName);
        $view = new View();
        $view->templateName = $templateName;

        global $config;
//        var_dump($config);
        $view->disableShortcut = $config->sf2->views['auto_shortcut_create'];

        return $view;
    }

    public function toggleShortcut($bool) {
        $this->disableShortcut = $bool;
    }

    public function output($return) {
        $rfc = new \ReflectionObject($this);
        $vars = [];
        foreach ($rfc->getProperties() as $property) {
            if ($property->name != "templateName" && $property->name != "disableShortcut") {
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

    public function __set($name, $value) {
        global $config;
        if ($this->disableShortcut && stripos(substr($value, 0, strlen($config->sf2->views['shortcut_create'])), $config->sf2->views['shortcut_create']) !== false) {
            $this->$name = View::create(substr($value, strlen($config->sf2->views['shortcut_create'])));

            return;
        }
        $this->$name = $value;
    }

    public function __toString() {
        return $this->output(true);
    }
} 