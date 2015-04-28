<?php

class Controller
{
    private $name;
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    protected function getView()
    {
        return $this->view;
    }
}
