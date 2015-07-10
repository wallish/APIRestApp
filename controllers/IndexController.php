<?php

class IndexController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
 
        Acl::checkAcl();
        
        //$game = Game::getInstance()->fetchAll(1);
        $game = Game::getInstance()->fetchList();
        die(var_dump($game));
        $xml = new MyXMLParser();
        //echo $xml->generate($game);

        
        $xmlstring =  $xml->generate($game);
        $sxe = simplexml_load_string($xmlstring);
        
        echo $xmlstring;
       
       
        $xml = new DOMDocument();
        $xml->load($xmlstring);
        if (!$xml->schemaValidate('XML/jeuxvideo.xsd')) {
            print '<b>DOMDocument::schemaValidate() Generated Errors!</b>';
        } else {
            echo 'ok';
        }
        




        /*$xml = simplexml_load_string($xmlstring);
        $json = json_encode($xml);
        
        echo $json;*/

        //$this->getView()->render('index/index', ['users' => $foo]);
    }

    public function showAction()
    {
        $user = User::getInstance()->fetchEntry(['field' => 'id', 'search' => 1]);

        $this->getView()->render('index/show', ['user' => $user[0]]);
    }


    public function getformAction($args = null)
    {
        $gameMode = $gameGenre = $gameTheme = $gameSupport = $gameEditor = null;
        if($args){
            if($args[0] == 'id' && $args[1] != ""){
                $game = Game::getInstance()->fetchEntry(array('field' => 'jeu_id', 'search' => $args[1]));
                $gameMode = GameMode::getInstance()->fetchEntry(array('field' => 'jeu_mode_jeu_id', 'search' => $args[1]));
                $gameGenre = GameGenre::getInstance()->fetchEntry(array('field' => 'jeu_genre_jeu_id', 'search' => $args[1]));
                $gameTheme = GameTheme::getInstance()->fetchEntry(array('field' => 'jeu_theme_jeu_id', 'search' => $args[1]));
                $gameSupport = GameSupport::getInstance()->fetchEntry(array('field' => 'jeu_support_jeu_id', 'search' => $args[1]));
                $gameEditor = GameEditor::getInstance()->fetchEntry(array('field' => 'jeu_editeur_jeu_id', 'search' => $args[1]));
            }
        }
       
        //die(var_dump($gameSupport[0]));
        $bar = [];
        $bar['jeu']['jeu_titre'] = ['type' => 'text', 'value' => ($game[0]['jeu_titre']) ?  utf8_encode($game[0]['jeu_titre']):''];
        $bar['jeu']['jeu_description'] = ['type' => 'text', 'value' => ($game[0]['jeu_description']) ?  utf8_encode($game[0]['jeu_description']):''];
        $bar['jeu']['jeu_siteweb'] = ['type' => 'text', 'value' => ($game[0]['jeu_site_web']) ?  utf8_encode($game[0]['jeu_site_web']):''];
        
        $mode = Mode::getInstance()->fetchEntries();
        $bar['mode']['mode_id'] = ['type' => 'text', 'value' => ($gameMode[0]['jeu_mode_mode_id']) ? $gameMode[0]['jeu_mode_mode_id']:''];
        $bar['mode']['mode_libelle'] = ['type' => 'text', 'value' => ''];
        foreach ($mode as $key => $value) {
            //$bar['mode'][] = ['mode_id' => $value['mode_id'], 'mode_libelle' => $value['mode_libelle']];
            $bar['mode']['data'][] = ['mode_id' => $value['mode_id'], 'mode_libelle' => utf8_encode($value['mode_libelle'])];
        }

        $genre = Genre::getInstance()->fetchEntries();
        $bar['genre']['genre_id'] = ['type' => 'text', 'value' => ($gameGenre[0]['jeu_genre_genre_id']) ? $gameGenre[0]['jeu_genre_genre_id']:''];
        $bar['genre']['genre_libelle'] = ['type' => 'text', 'value' => ''];
        foreach ($genre as $key => $value) {
            $bar['genre']['data'][] = ['genre_id' => $value['genre_id'], 'genre_libelle' => utf8_encode($value['genre_libelle'])];
        }

        $theme = Theme::getInstance()->fetchEntries();
        $bar['theme']['theme_id'] = ['type' => 'text', 'value' => ($gameTheme[0]['jeu_theme_theme_id']) ? $gameTheme[0]['jeu_theme_theme_id']:''];
        $bar['theme']['theme_libelle'] = ['type' => 'text', 'value' => ''];
        foreach ($theme as $key => $value) {
            $bar['theme']['data'][] = ['theme_id' => $value['theme_id'], 'theme_libelle' => utf8_encode($value['theme_libelle'])];
        }
        //die(var_dump($bar['theme']['data']));

        $support = Support::getInstance()->fetchEntries();
        $bar['support']['support_id'] = ['type' => 'text', 'value' => ($gameSupport[0]['jeu_support_support_id']) ? $gameSupport[0]['jeu_support_support_id']:''];
        $bar['support']['support_libelle'] = ['type' => 'text', 'value' => ''];
        foreach ($support as $key => $value) {
            $bar['support']['data'][] = ['support_id' => $value['support_id'], 'support_libelle' => utf8_encode($value['support_libelle'])];
        }

        $editor = Editor::getInstance()->fetchEntries();
        $bar['editeur']['editeur_id'] = ['type' => 'text', 'value' => ($gameEditor[0]['jeu_editeur_editeur_id']) ? $gameEditor[0]['jeu_editeur_editeur_id']:''];
        $bar['editeur']['editeur_nom'] = ['type' => 'text', 'value' => ''];
        foreach ($editor as $key => $value) {
            $bar['editeur']['data'][] = ['editeur_id' => $value['editeur_id'], 'editeur_nom' => utf8_encode($value['editeur_nom'])];
        }

        echo json_encode($bar, JSON_PRETTY_PRINT);

    }


}
