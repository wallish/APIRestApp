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
        $bar['jeu_titre'] = ['type' => 'text', 'value' => ($game[0]['jeu_titre']) ?  utf8_encode($game[0]['jeu_titre']):'', "label" => "Titre du jeu"];
        $bar['jeu_description'] = ['type' => 'textarea', 'value' => ($game[0]['jeu_description']) ?  utf8_encode($game[0]['jeu_description']):'', "label" => "Description du jeu"];
        $bar['jeu_siteweb'] = ['type' => 'text', 'value' => ($game[0]['jeu_site_web']) ?  utf8_encode($game[0]['jeu_site_web']):'', "label" => "Siteweb"];
        
        $mode = Mode::getInstance()->fetchEntries();
        $bar['mode']['type'] = 'select';
        $bar['mode']['value'] = ($gameMode[0]['jeu_mode_mode_id']) ? $gameMode[0]['jeu_mode_mode_id']:'';
        $bar['mode']['label'] = "Mode";
        foreach ($mode as $key => $value) {
            //$bar['mode'][] = ['mode_id' => $value['mode_id'], 'mode_libelle' => $value['mode_libelle']];
            $bar['mode']['data'][] = ['id' => $value['mode_id'], 'libelle' => utf8_encode($value['mode_libelle'])];
        }

        $genre = Genre::getInstance()->fetchEntries();
        $bar['genre']['type'] = 'select';
        $bar['genre']['value'] = ($gameGenre[0]['jeu_genre_genre_id']) ? $gameGenre[0]['jeu_genre_genre_id']:'';
        $bar['genre']['label'] = "Genre";
        foreach ($genre as $key => $value) {
            $bar['genre']['data'][] = ['id' => $value['genre_id'], 'libelle' => utf8_encode($value['genre_libelle'])];
        }

        $theme = Theme::getInstance()->fetchEntries();
        $bar['theme']['type'] = 'select';
        $bar['theme']['value'] = ($gameTheme[0]['jeu_theme_theme_id']) ? $gameTheme[0]['jeu_theme_theme_id']:'';
        $bar['theme']['label'] = "Theme";
        foreach ($theme as $key => $value) {
            $bar['theme']['data'][] = ['id' => $value['theme_id'], 'libelle' => utf8_encode($value['theme_libelle'])];
        }
        //die(var_dump($bar['theme']['data']));

        $support = Support::getInstance()->fetchEntries();
        $bar['support']['type'] = 'select';
        $bar['support']['value'] = ($gameSupport[0]['jeu_support_support_id']) ? $gameSupport[0]['jeu_support_support_id']:'';
        $bar['support']['label'] = "Support";
        foreach ($support as $key => $value) {
            $bar['support']['data'][] = ['id' => $value['support_id'], 'libelle' => utf8_encode($value['support_libelle'])];
        }

        $editor = Editor::getInstance()->fetchEntries();
        $bar['editeur']['type'] = 'select';
        $bar['editeur']['value'] = ($gameEditor[0]['jeu_editeur_editeur_id']) ? $gameEditor[0]['jeu_editeur_editeur_id']:'';
        $bar['editeur']['label'] = "Editeur";
        foreach ($editor as $key => $value) {
            $bar['editeur']['data'][] = ['id' => $value['editeur_id'], 'libelle' => utf8_encode($value['editeur_nom'])];
        }

        echo json_encode($bar, JSON_PRETTY_PRINT);

    }


}
