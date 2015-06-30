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
                /*$foo = "<?xml version=\"1.0\"?>\n";*/

                echo $final_xml;
            }

        } else {
            header('HTTP/1. 405 Method Not Allowed');
        }

    }

    public function addAction()
    {
        if (Request::isPost()) {


            $jeuId = "";
            $consoleId = "";
            $resultGame = Game::getInstance()->save($_REQUEST['game'], Game::getInstance()->getTable());
            $jeuId = $resultGame['id'];
            $resultConsole = Console::getInstance()->save($_REQUEST['console'], Console::getInstance()->getTable());
            $consoleId = $resultConsole['id'];
          //  $resultCaracteristique = Caracteristique::getInstance()->save($_REQUEST['console'], Caracteristique::getInstance()->getTable());

            foreach ($_REQUEST['console_caracteristique'] as $key => $value) {
                $value['console_caracteristique_console_id'] = $consoleId;
                $resultConsoleCaracteristique = ConsoleFeatures::getInstance()->save($value, ConsoleFeatures::getInstance()->getTable());
            }

            $_REQUEST['jeu_console']['jeu_console_jeu_id'] = $jeuId;
            $_REQUEST['jeu_console']['jeu_console_console_id'] = $consoleId;

            $resultGameConsole = GameConsole::getInstance()->save($_REQUEST['jeu_console'], GameConsole::getInstance()->getTable());


            foreach ($_REQUEST['commentaire'] as $key => $value) {
                $value['commentaire_jeu_console_jeu_id'] = (int)$jeuId;
                $value['commentaire_jeu_console_console_id'] = (int)$consoleId;
                $resultCommentaire = Comment::getInstance()->save($value, Comment::getInstance()->getTable());
            }

               die(var_dump($resultGame));
            if ($result['code'] = 1) {
                header('HTTP/1. 201 Created');
            }
        } else {
            header('HTTP/1. 405 Method Not Allowed');
        }

        die('GameController/add');
    }

   /* public function deleteAction()
    {
        if (Request::isDelete()) {
            header('HTTP/1. 204 No Content');
            parse_str(file_get_contents('php://input'), $post_content);
            var_dump($put_content);
        } else {
            header('HTTP/1. 405 Method Not Allowed');
        }

        die('GameController/delete');
    }*/

    public function updateAction()
    {
        if (Request::isPut()) {
            header('HTTP/1. 200 OK');
            parse_str(file_get_contents('php://input'), $post_content);
            var_dump($put_content);
            $result = Game::getInstance()->desactivate($post_content, Game::getInstance()->getTable());
        } else {
            header('HTTP/1. 405 Method Not Allowed');
        }

        die('GameController/update');
    }

    public function deleteAction()
    {
        if (Request::isDelete()) {
           // header('HTTP/1. 204 No Content');
            parse_str(file_get_contents('php://input'), $post_content);

            $result = Game::getInstance()->desactivate($post_content['id'], Game::getInstance()->getTable());

            //var_dump($put_content);
        } else {
            header('HTTP/1. 405 Method Not Allowed');
        }
    }
}
