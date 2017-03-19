<?php

class Home extends Controller
{
    public function index($name = '')
    {
        $this->model('User');
    }

    public function test()
    {
    }

}