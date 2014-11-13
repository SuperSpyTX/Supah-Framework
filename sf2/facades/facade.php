<?php
/**
 * Created by PhpStorm.
 * User: Joe
 * Date: 11/11/2014
 * Time: 3:34 PM
 */

namespace Supah_Framework\Facades;

class Facade {
    static $className = '';
    private $object = null;

    public function __construct($args) {
        $rfc = new \ReflectionClass($this::$className);
        if (!is_array($args)) {
            $args = [$args];
        }

        $this->object = $rfc->newInstanceArgs($args);
    }

    /**
     * @deprecated
     */
    public function getObject() {
        return $this->object;
    }

    public function __set($name, $value) {
        if ($this->object == null)
            return;
        $this->object->$name = $value;
    }

    public function __get($name) {
        if ($this->object == null)
            return null;
        return $this->object->$name;
    }

    public function __isset($name) {
        if ($this->object == null)
            return false;
        return isset($this->object->$name);
    }

    public function __unset($name) {
        if ($this->object == null)
            return;
        unset($this->object->$name);
    }

    public function __call($method, $args) {
        $rfc = new \ReflectionClass($this::$className);
        $instance = $rfc->newInstanceWithoutConstructor();

        if ($this->object != null) {
            $instance = $this->object;
        }

        return $rfc->getMethod($method)->invokeArgs($instance, $args);
    }

    public function __toString() {
        $rfc = new \ReflectionClass($this::$className);
        $instance = $rfc->newInstanceWithoutConstructor();
        if ($this->object != null) {
            $instance = $this->object;
        }

        if ($rfc->getMethod("__toString") != null) {
            return $rfc->getMethod("__toString")->invoke($instance);
        }

        return "";
    }

    public static function __callStatic($method, $args) {
        $rfc1 = new \ReflectionClass(get_called_class());
        $rfc = new \ReflectionClass($rfc1->getProperty('className')->getValue(null));

        return $rfc->getMethod($method)->invokeArgs(null, $args);
    }
} 