<?php

class App
{

    private $controller = 'home';
    private $method = 'index';
    private $params = [];

    protected function getController(){
        return $this->controller;
    }

    protected function setController($newController){
        return $this->controller = $newController;
    }

    public function __construct()
    {
        $url = $this->parseUrl();
        $controllerName = $url[0];

        if (Controller::withNameExists($controllerName)) {
            $this->setController($controllerName);
        }

        require_once Controller::getControllerPathByName($controllerName);
    }

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