<?php

define("DEFAULT_CONTROLLER", "home");
define("DEFAULT_METHOD", "index");

class App
{

    private $controllerObj = DEFAULT_CONTROLLER;
    private $method = DEFAULT_METHOD;
    private $params = [];

    protected function getController()
    {
        return $this->controllerObj;
    }

    protected function setController($newController)
    {
        return $this->controllerObj = $newController;
    }

    public function __construct()
    {
        //Get url parameters
        $url = $this->parseUrl() ?: [];

        //Parse first parameter (controller)
        if (array_key_exists(0, $url) && Controller::withNameExists($url[0])) {
            $this->controllerObj = $url[0];
        }

        require_once Controller::getControllerPathByName($this->controllerObj);

        $this->controllerObj = new $this->controllerObj;

        //Parse second parameter (method)
        if (array_key_exists(1, $url) && $this->controllerObj->hasMethode($url[1])) {
            $this->method = $url[1];
        }
        echo 'use method ' . $this->controllerObj->getName() . '::' . $this->method;
    }

    /**
     * @return array
     */
    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return $url = explode(
                '/',
                filter_var(
                    rtrim($_GET['url'], '/'),
                    FILTER_SANITIZE_URL)
            );
        }
    }
}