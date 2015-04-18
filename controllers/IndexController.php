<?php

class IndexController extends Controller
{
    public function __construct()
    {
    }

    public function indexAction()
    {
        $foo = User::getInstance()->fetchEntry('username', 'foobar');
        $game = Game::getInstance()->save(array());

        var_dump($game);
        echo '<pre>';

        die('IndexController/Index');
    }
}
