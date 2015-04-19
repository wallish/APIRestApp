<?php

class IndexController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $foo = User::getInstance()->fetchAll();

        $this->getView()->render('index/index', ['users' => $foo]);

        die('IndexController/Index');
    }

    public function showAction()
    {
        $user = User::getInstance()->fetchEntry(['field' => 'id', 'search' => 1]);

        $this->getView()->render('index/show', ['user' => $user[0]]);
    }
}
