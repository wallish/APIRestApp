<?php

class MyXMLParser
{
    private $id = null;
    private $gamesXML = null;

    function __construct() {
         $this->gamesXML = new SimpleXMLElement('<catalogue></catalogue>');
    }


    public function generate($gameData, $headerXml = true)
    {
        //die(var_dump($gamesXML));   
        //init => root
        $this->id = $gameData['jeu_id'];
        $editor = GameEditor::getInstance()->fetchAll($gameData['jeu_id']);
        $genre = GameGenre::getInstance()->fetchAll($gameData['jeu_id']);
        $theme = GameTheme::getInstance()->fetchAll($gameData['jeu_id']);
        $support = GameSupport::getInstance()->fetchAll($gameData['jeu_id']);
        $mode = GameMode::getInstance()->fetchAll($gameData['jeu_id']);
        $console = GameConsole::getInstance()->fetchAll($gameData['jeu_id']);
        
        $comment = Comment::getInstance()->fetchAll($gameData['jeu_id']);

//        die(var_dump($feature));
        $games = $this->gamesXML->addChild('jeu');
        $games->addAttribute('jeuId', $gameData['jeu_id']);
        $games->addChild('titre', $gameData['jeu_titre']);

        $this->editeur($editor, $games);
        $this->console($console, $games, $comment);
        $games->addChild('description', utf8_encode($gameData['jeu_description']));
        $games->addChild('siteweb', $gameData['jeu_site_web']);
        $this->genre($genre, $games);
        $this->theme($theme, $games);
        $this->support($support, $games);
        $this->mode($mode, $games);

        if ($headerXml) Header('Content-type: text/xml; charset=utf-8');

        return $this->gamesXML->asXML();
    }



    public function console($data, $parent, $comment)
    {
        $consoles = $parent->addChild('consoles');
        foreach ($data as $key => $value) {
            $console = $consoles->addChild('console');
            $console->addAttribute('dateSortieJeu', date('Y-m-d',strtotime($value['jeu_console_date_sortie'])));
            $console->addAttribute('classification', $value['jeu_console_classification']);
            $console->addChild('nomConsole', $value['console_nom']);
            $console->addChild('dateDeSortie', date('Y-m-d',strtotime($value['console_date_sortie'])));
            $attri = $console->addChild('prixJeu', utf8_encode($value['jeu_console_prix']));
            $attri->addAttribute('devise', '€');
            $attri = $console->addChild('prix', utf8_encode($value['console_prix']));
            $attri->addAttribute('devise', '€');
           
           $this->media(null, $console, utf8_encode($value['console_id']), $this->id);

            $this->caracteristique(null, $console, utf8_encode($value['console_id']));
            $foo = $console->addChild('commentaires');
            foreach ($comment as $key => $c) { //die(var_dump($c));
                //die(var_dump($c));
                if($value['jeu_console_console_id'] == $c['commentaire_jeu_console_console_id'])
                    $this->commentaire($c, $foo );


            }
            //$this->caracteristique();
        }
    }

    public function caracteristique($data, $parent, $id)
    {
        $caracteristique = $parent->addChild('caracteristiques');

        $feature = ConsoleFeatures::getInstance()->fetchAll($id);

        foreach ($feature as $key => $value) {
            $caracteristique->addChild($value['caracteristique_nom'], utf8_encode($value['console_caracteristique_valeur']));
        }

    }

    public function media($data, $parent, $consoleId)
    {
        $medias = $parent->addChild('medias');

        $media = Media::getInstance()->fetchAll($consoleId, $this->id);
        foreach ($media as $key => $value) {
            $media = $medias->addChild('media', utf8_encode($value['media_url']));
            $media->addAttribute('type', utf8_encode($value['media_type_libelle']));
        }
    }

    public function commentaire($data, $commentaires)
    {
        //$commentaires = $parent->addChild('commentaires');
       // $data[] =  ['commentaire_utilisateur' => 'BeerFr0mHell', 'commentaire_date' => '2014-11-21', 'commentaire_note' => '18', 'commentaire_contenu' => 'rockstartgames.com'];
       // $data[] =  ['commentaire_utilisateur' => 'BeerFr0mHell', 'commentaire_date' => '2014-11-21', 'commentaire_note' => '18', 'commentaire_contenu' => 'rockstartgames.com'];
        $str = ['commentaire_utilisateur' => 'utilisateur', 'commentaire_date' => 'date', 'commentaire_note' => 'note', 'commentaire_contenu' => 'contenu'];
        //foreach ($data as $key => $value) {

            $commentaire = $commentaires->addChild('commentaire');
            $commentaire->addChild('utilisateur', utf8_encode($data['commentaire_utilisateur']));
            $commentaire->addChild('date', utf8_encode($data['commentaire_date']));
            $commentaire->addChild('note', utf8_encode($data['commentaire_note']));
            $commentaire->addChild('contenu', utf8_encode($data['commentaire_contenu']));
        //}
            //die(var_dump($commentaires));
    }

    public function editeur($data, $parent)
    {
        $editeurs = $parent->addChild('editeurs');
        /*
        $data[] =  ['editeur_nom' => 'RockstarGames', 'editeur_annee_creation' => '1998', 'editeur_pays' => 'USA', ' editeur_site_web' => 'rockstartgames.com', 'editeur_fondateur' => 'Sam Houser'];
        $data[] =  ['editeur_nom' => 'Take-Two Interctive', 'editeur_annee_creation' => '1993', 'editeur_pays' => 'USA', ' editeur_site_web' => 'take2games.com', 'editeur_fondateur' => 'Ryan Brant'];
        */

        $str = ['editeur_nom' => 'nom', 'editeur_annee_creation' => 'anneeCreation', 'editeur_pays' => 'pays', 'editeur_site_web' => 'sitewebediteur', 'editeur_fondateur' => 'fondateur'];

        foreach ($data as $key => $value) {
            $editeur = $editeurs->addChild('editeur');
            foreach ($value as $key => $pcdata) { 
                if(isset($str[$key]))
                    $editeur->addChild((string) $str[$key], utf8_encode($pcdata));
            }
        }
    }

    public function genre($data, $parent)
    {
        $genres = $parent->addChild('genres');

        foreach ($data as $key => $value) {
            $genres->addChild('genre', utf8_encode($value['genre_libelle']));
        }
    }

    public function theme($data, $parent)
    {
        $themes = $parent->addChild('themes');

        foreach ($data as $key => $value) {
            $themes->addChild('theme', utf8_encode($value['theme_libelle']));
        }
    }

    public function support($data, $parent)
    {
        $supports = $parent->addChild('supports');

        foreach ($data as $key => $value) {
            $supports->addChild('support', utf8_encode($value['support_libelle']));
        }
    }

    public function mode($data, $parent)
    {
        $modes = $parent->addChild('modes');

        foreach ($data as $key => $value) {
            $modes->addChild('mode', utf8_encode($value['mode_libelle']));
        }
    }

    public function checker($data)
    {
        $xml = new DOMDocument();
        $xml->load($data);

        if (!$xml->schemaValidate('XML/jeuxvideo.xsd')) {
            print '<b>DOMDocument::schemaValidate() Generated Errors!</b>';
        } else {
            echo 'ok';
        }
    }
}
