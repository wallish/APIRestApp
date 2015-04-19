<?php

class GameController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction($request = null)
    {
        //$game = Game::getInstance()->save(array());

        $this->getView()->set('foo', 'bar');
        $this->getView()->render('game/index');
        die('GameController/Index');
    }

    public function testAction()
    {
        die('GameController/Test');
    }

    public function addAction()
    {
        if (Request::isPost()) {
            $result = User::getInstance()->save($_REQUEST, Game::getInstance()->getTable());
        }

        die('GameController/add');
    }

    public function deleteAction()
    {
        if (Request::isDelete()) {
            parse_str(file_get_contents('php://input'), $post_content);
            var_dump($put_content);
        }

        die('GameController/delete');
    }

    public function updateAction()
    {
        if (Request::isPut()) {
            parse_str(file_get_contents('php://input'), $post_content);
            var_dump($put_content);
            $result = User::getInstance()->save($post_content, Game::getInstance()->getTable());
        }

        die('GameController/update');
    }
}
