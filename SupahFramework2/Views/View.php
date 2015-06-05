<?php
/**
 * Created by PhpStorm.
 * User: Joe
 * Date: 11/12/2014
 * Time: 12:36 AM
 */

namespace SupahFramework2\Views;

class View {
    private $templateName = "";
    private $disableShortcut = false;

    public static function create($templateName) {
        $view = new View();
        $view->templateName = $templateName;

        $view->disableShortcut = resolve('configuration')->sf2()->views['auto_shortcut_create'];

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
        include(APPLICATION_PATH . "/Web/Views/" . ucfirst($this->templateName) . ".php");
        $str = ob_get_clean();

        if (!$return) {
            echo $str;
        } else {
            return $str;
        }
    }

    public function __set($name, $value) {
        if ($this->disableShortcut && stripos(substr($value, 0, strlen(resolve('configuration')->sf2()->views['shortcut_create'])), resolve('configuration')->sf2()->views['shortcut_create']) !== false) {
            $this->$name = View::create(substr($value, strlen(resolve('configuration')->sf2()->views['shortcut_create'])));

            return;
        }
        $this->$name = $value;
    }

    public function __toString() {
        return $this->output(true);
    }
} 