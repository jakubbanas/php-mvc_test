<?php

define('CONTROLLERS_PATH', __DIR__ . '/../controllers/');

class Controller
{

    public static function withNameExists($name)
    {
        return file_exists(CONTROLLERS_PATH . $name . '.php');
    }

    public static function getControllerPathByName($name)
    {
        return CONTROLLERS_PATH . $name . '.php';
    }

}