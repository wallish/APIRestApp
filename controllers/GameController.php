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

    public function getAction($args)
    { 
        if (Request::isGet()) {
            header('HTTP/1. 200 OK');
            //$result = Game::getInstance()->save($_REQUEST, Game::getInstance()->getTable());

            $game = Game::getInstance()->fetchAll(1);
            $xml = new MyXMLParser();
            //echo $xml->generate($game);

            
        } else {
            header('HTTP/1. 405 Method Not Allowed');
        }

    }

    public function addAction()
    {
        if (Request::isPost()) {
            $result = Game::getInstance()->save($_REQUEST, Game::getInstance()->getTable());
            if ($result['code'] = 1) {
                header('HTTP/1. 201 Created');
            }
        } else {
            header('HTTP/1. 405 Method Not Allowed');
        }

        die('GameController/add');
    }

    public function deleteAction()
    {
        if (Request::isDelete()) {
            header('HTTP/1. 204 No Content');
            parse_str(file_get_contents('php://input'), $post_content);
            var_dump($put_content);
        } else {
            header('HTTP/1. 405 Method Not Allowed');
        }

        die('GameController/delete');
    }

    public function updateAction()
    {
        if (Request::isPut()) {
            header('HTTP/1. 200 OK');
            parse_str(file_get_contents('php://input'), $post_content);
            var_dump($put_content);
            $result = Game::getInstance()->save($post_content, Game::getInstance()->getTable());
        } else {
            header('HTTP/1. 405 Method Not Allowed');
        }

        die('GameController/update');
    }
}
