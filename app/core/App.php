<?php

define("DEFAULT_CONTROLLER", "home");
define("DEFAULT_METHOD", "index");

class App
{

    private $controller;
    private $method;
    private $params = [];

    protected function getController()
    {
        return $this->controller;
    }

    protected function setController($newController)
    {
        return $this->controller = $newController;
    }

    public function __construct()
    {
        //Get url parameters
        $url = $this->parseUrl();

        //Parse first parameter (controller)
        if (isset($url[0])) {
            $controllerName = $url[0];
            $this->controller = Controller::withNameExists($controllerName) ? $controllerName : DEFAULT_CONTROLLER;
            require_once Controller::getControllerPathByName($this->controller);
        }

        $this->controller = new $this->controller;

        //Parse second parameter (method)
        if (isset($url[1])) {
            $methodName = $url[1];
            $this->method = $this->controller->hasMethode($methodName) ? $methodName : DEFAULT_METHOD;
            echo 'use method ' . $controllerName . '::' . $this->method;
        }
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