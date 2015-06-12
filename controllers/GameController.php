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
            //die(var_dump($args));
           
            if($args[0] == 'id' && $args[1] != "")
            {
                $game = Game::getInstance()->fetchAll($args[1]);
                if(!empty($game)){
                    $xml = new MyXMLParser();
                    echo $xml->generate($game[0]);
                } else {
                    die('error');
                }
                    
            }else {
                $games = Game::getInstance()->fetchList();
                $xml = new MyXMLParser();
                foreach ($games as $key => $game) {
                    $final_xml = str_replace("<?xml version=\"1.0\"?>\n",'',$xml->generate($game, true));
                    
                }
                echo $final_xml;
            }




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
