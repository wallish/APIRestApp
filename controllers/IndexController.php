<?php

class IndexController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        //$foo = Game::getInstance()->fetchEntry(1);
        $foo = GameConsole::getInstance()->fetchAll(1);
        $foo = ConsoleFeatures::getInstance()->fetchAll(1);
        print_r($foo);
        /*$xml = new MyXMLParser();
        echo $xml->generate();/*/

        //$this->getView()->render('index/index', ['users' => $foo]);
    }

    public function showAction()
    {
        $user = User::getInstance()->fetchEntry(['field' => 'id', 'search' => 1]);

        $this->getView()->render('index/show', ['user' => $user[0]]);
    }
}
