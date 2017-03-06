<?php

define('CONTROLLERS_PATH', __DIR__ . '/../controllers/');

class Controller
{
    /**
     * @param $name
     * @return bool
     */
    final public static function withNameExists($name)
    {
        return file_exists(CONTROLLERS_PATH . $name . '.php');
    }

    /**
     * @param $name
     * @return string
     */
    final public static function getControllerPathByName($name)
    {
        return CONTROLLERS_PATH . $name . '.php';
    }

    /**
     * @param $methodeName
     * @return bool
     */
    final public function hasMethode($methodeName)
    {
        return method_exists($this, $methodeName);
    }

    public function getName()
    {
        return get_class($this);
    }

}