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
                    $outputXML=str_replace('<?xml version="1.0"?>', '<?xml version="1.0" encoding="UTF-8"?>', $xml->generate($game[0]));
                    echo $outputXML;

                } else {
                    die('error');
                }
                    
            }else {
                $games = Game::getInstance()->fetchList();
                $xml = new MyXMLParser();
                foreach ($games as $key => $game) {
                    $final_xml = str_replace("<?xml version=\"1.0\"?>\n",'',$xml->generate($game, true));
                    
                }
                $foo = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
                header ("Content-Type:text/xml; charset=utf-8");
                echo $foo.$final_xml;
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


            if(isset($_REQUEST['mode']['mode_libelle'])){
                $mode = Mode::getInstance()->save($_REQUEST['mode']['mode_libelle'], Mode::getInstance()->getTable());
                $jeuMode = GameMode::getInstance()->save(array('jeu_id' => $jeuId,'mode_id' => $mode['id'], GameMode::getInstance()->getTable()));
            } else if (isset($_REQUEST['mode']['mode_id'])){
                $jeuMode = GameMode::getInstance()->save(array('jeu_id' => $jeuId,'mode_id' => $_REQUEST['mode']['mode_id'], GameMode::getInstance()->getTable()));
            }
            
            if(isset($_REQUEST['theme']['theme_libelle'])){
                $theme = Theme::getInstance()->save($_REQUEST['theme']['theme_libelle'], Mode::getInstance()->getTable());
                $jeuTheme = GameTheme::getInstance()->save(array('jeu_id' => $jeuId,'theme_id' => $theme['id'], GameTheme::getInstance()->getTable()));
            } else if (isset($_REQUEST['theme']['theme_id'])){
                $jeuTheme = GameTheme::getInstance()->save(array('jeu_id' => $jeuId,'theme_id' => $_REQUEST['theme']['theme_id'], GameTheme::getInstance()->getTable()));
            }

            if(isset($_REQUEST['editeur']['editeur_libelle'])){
                $editor = Editor::getInstance()->save($_REQUEST['editeur']['editeur_libelle'], Mode::getInstance()->getTable());
                $jeuEditor = GameTheme::getInstance()->save(array('jeu_id' => $jeuId,'editor_id' => $editor['id'], GameEditor::getInstance()->getTable()));
            } else if (isset($_REQUEST['editeur']['editeur_id'])){
                $jeuEditor = GameTheme::getInstance()->save(array('jeu_id' => $jeuId,'editor_id' => $_REQUEST['editeur']['editeur_id'], GameEditor::getInstance()->getTable()));

            }

            if(isset($_REQUEST['genre']['genre_libelle'])){
                $genre = Genre::getInstance()->save($_REQUEST['genre']['genre_libelle'], Mode::getInstance()->getTable());
                $jeuGenre = GameGenre::getInstance()->save(array('jeu_id' => $jeuId,'genre_id' => $genre['id'], GameGenre::getInstance()->getTable()));
            } else if (isset($_REQUEST['genre']['genre_id'])){
                $jeuGenre = GameGenre::getInstance()->save(array('jeu_id' => $jeuId,'genre_id' => $_REQUEST['genre']['genre_id'], GameGenre::getInstance()->getTable()));

            }

            if(isset($_REQUEST['support']['support_libelle'])){
                $support = Support::getInstance()->save($_REQUEST['support']['support_libelle'], Mode::getInstance()->getTable());
                $jeuSupport = GameSupport::getInstance()->save(array('jeu_id' => $jeuId,'support_id' => $support['id'], GameSupport::getInstance()->getTable()));
            } else if (isset($_REQUEST['support']['support_id'])){
                $jeuSupport = GameSupport::getInstance()->save(array('jeu_id' => $jeuId,'support_id' => $_REQUEST['support']['support_id'], GameSupport::getInstance()->getTable()));
            }


               die(var_dump($resultGame));
            if ($result['code'] = 1) {
                header('HTTP/1. 201 Created');
            }
        } else {
            header('HTTP/1. 405 Method Not Allowed');
        }
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
            //var_dump($put_content);
            //$result = Game::getInstance()->save($post_content, Game::getInstance()->getTable());


            $jeuId = $post_content['game']['jeu_id'];
            $resultGame = Game::getInstance()->save($post_content['game'], Game::getInstance()->getTable());


            if(isset($post_content['mode']['mode_libelle'])){
                $mode = Mode::getInstance()->save($post_content['mode']['mode_libelle'], Mode::getInstance()->getTable());
                $jeuMode = GameMode::getInstance()->save(array('jeu_id' => $jeuId,'mode_id' => $mode['id'], GameMode::getInstance()->getTable()));
            } else if (isset($post_content['mode']['mode_id'])){
                $jeuMode = GameMode::getInstance()->save(array('jeu_id' => $jeuId,'mode_id' => $post_content['mode']['mode_id'], GameMode::getInstance()->getTable()));
            }
            
            if(isset($post_content['theme']['theme_libelle'])){
                $theme = Theme::getInstance()->save($post_content['theme']['theme_libelle'], Mode::getInstance()->getTable());
                $jeuTheme = GameTheme::getInstance()->save(array('jeu_id' => $jeuId,'theme_id' => $theme['id'], GameTheme::getInstance()->getTable()));
            } else if (isset($post_content['theme']['theme_id'])){
                $jeuTheme = GameTheme::getInstance()->save(array('jeu_id' => $jeuId,'theme_id' => $post_content['theme']['theme_id'], GameTheme::getInstance()->getTable()));
            }

            if(isset($post_content['editeur']['editeur_libelle'])){
                $editor = Editor::getInstance()->save($post_content['editeur']['editeur_libelle'], Mode::getInstance()->getTable());
                $jeuEditor = GameTheme::getInstance()->save(array('jeu_id' => $jeuId,'editor_id' => $editor['id'], GameEditor::getInstance()->getTable()));
            } else if (isset($post_content['editeur']['editeur_id'])){
                $jeuEditor = GameTheme::getInstance()->save(array('jeu_id' => $jeuId,'editor_id' => $post_content['editeur']['editeur_id'], GameEditor::getInstance()->getTable()));

            }

            if(isset($post_content['genre']['genre_libelle'])){
                $genre = Genre::getInstance()->save($post_content['genre']['genre_libelle'], Mode::getInstance()->getTable());
                $jeuGenre = GameGenre::getInstance()->save(array('jeu_id' => $jeuId,'genre_id' => $genre['id'], GameGenre::getInstance()->getTable()));
            } else if (isset($post_content['genre']['genre_id'])){
                $jeuGenre = GameGenre::getInstance()->save(array('jeu_id' => $jeuId,'genre_id' => $post_content['genre']['genre_id'], GameGenre::getInstance()->getTable()));

            }

            if(isset($post_content['support']['support_libelle'])){
                $support = Support::getInstance()->save($post_content['support']['support_libelle'], Mode::getInstance()->getTable());
                $jeuSupport = GameSupport::getInstance()->save(array('jeu_id' => $jeuId,'support_id' => $support['id'], GameSupport::getInstance()->getTable()));
            } else if (isset($post_content['support']['support_id'])){
                $jeuSupport = GameSupport::getInstance()->save(array('jeu_id' => $jeuId,'support_id' => $post_content['support']['support_id'], GameSupport::getInstance()->getTable()));
            }


        } else {
            header('HTTP/1. 405 Method Not Allowed');
        }

        
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
