<?php

class IndexController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $game = Game::getInstance()->fetchAll(1);
        //die(var_dump($foo));
        //$foo = GameEditor::getInstance()->fetchAll(1);
        //$foo = ConsoleFeatures::getInstance()->fetchAll(1);
   
        $xml = new MyXMLParser();
        echo $xml->generate($game);

        //$this->getView()->render('index/index', ['users' => $foo]);
    }

    public function showAction()
    {
        $user = User::getInstance()->fetchEntry(['field' => 'id', 'search' => 1]);

        $this->getView()->render('index/show', ['user' => $user[0]]);
    }
}
