<?php

class App
{

    private $controller = 'home';
    private $method = 'index';
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
        $url = $this->parseUrl();
        $controllerName = $url[0];
        $methodName = $url[1];

        if (Controller::withNameExists($controllerName)) {
            $this->controller = $controllerName;
        }

        require_once Controller::getControllerPathByName($this->controller);

        $this->controller = new $this->controller;

        if ($this->controller->hasMethode($methodName)) {
            $this->method = $methodName;
        } else {
            echo 'no method ' . $methodName . ', ';
        }

        echo 'use method ' . $controllerName . '::' . $this->method;
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