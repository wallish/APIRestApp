<?php

class MyXMLParser
{
    public function generate($gameData)
    {
        //init => root
        $gamesXML = new SimpleXMLElement('<catalogue></catalogue>');

        $editor = GameEditor::getInstance()->fetchAll($gameData[0]['jeu_id']);
        $genre = GameGenre::getInstance()->fetchAll($gameData[0]['jeu_id']);
        $theme = GameTheme::getInstance()->fetchAll($gameData[0]['jeu_id']);
        $support = GameSupport::getInstance()->fetchAll($gameData[0]['jeu_id']);
        $mode = GameMode::getInstance()->fetchAll($gameData[0]['jeu_id']);
        $console = GameConsole::getInstance()->fetchAll($gameData[0]['jeu_id']);
        $comment = Comment::getInstance()->fetchAll($gameData[0]['jeu_id']);

        $games = $gamesXML->addChild('jeu');
        $games->addAttribute('jeuId', $gameData[0]['jeu_id']);
        $games->addChild('titre', $gameData[0]['jeu_titre']);

        $this->editeur($editor, $games);
        $this->console($console, $games, $comment);
        $games->addChild('description', $gameData[0]['jeu_description']);
        $games->addChild('siteweb', $gameData[0]['jeu_site_web']);
        $this->genre($genre, $games);
        $this->theme($theme, $games);
        $this->support($support, $games);
        $this->mode($mode, $games);

        Header('Content-type: text/xml');

        return $gamesXML->asXML();
    }

    public function console($data, $parent, $comment)
    {
        $consoles = $parent->addChild('consoles');

        foreach ($data as $key => $value) {
            $console = $consoles->addChild('console');
            $console->addAttribute('dateSortieJeu', $value['jeu_console_date_sortie']);
            $console->addAttribute('classification', $value['jeu_console_classification']);
            $console->addChild('nomConsole', $value['console_nom']);
            $console->addChild('dateDeSortie', $value['console_date_sortie']);
            $attri = $console->addChild('prixJeu', $value['jeu_console_prix']);
            $attri->addAttribute('devise', '€');
            $attri = $console->addChild('prix', $value['console_prix']);
            $attri->addAttribute('devise', '€');
            //$this->media(null, $console);
            foreach ($comment as $key => $c) {
               // die(var_dump($c));
                //if($value['jeu_console_console_id'] == $c['commentaire_jeu_console_console_id'])
                   // $this->commentaire($c, $console);
            }
            //$this->caracteristique();
        }
    }

    public function caracteristique($data, $parent)
    {
        $caracteristique = $parent->addChild('caracteristique');
        $data[] =  ['commentaire_utilisateur' => 'BeerFr0mHell', 'commentaire_date' => '2014-11-21', 'commentaire_note' => '18', 'commentaire_contenu' => 'rockstartgames.com'];
        $data[] =  ['commentaire_utilisateur' => 'BeerFr0mHell', 'commentaire_date' => '2014-11-21', 'commentaire_note' => '18', 'commentaire_contenu' => 'rockstartgames.com'];

        $str = ['commentaire_utilisateur' => 'utilisateur', 'commentaire_date' => 'date', 'commentaire_note' => 'note', 'commentaire_contenu' => 'contenu'];

        foreach ($data as $key => $value) {
            $commentaire = $caracteristique->addChild('commentaire');
            $commentaire->addChild('cpu', $value['commentaire_utilisateur']);
            $commentaire->addChild('gpu', $value['commentaire_date']);
            $commentaire->addChild('ram', $value['commentaire_note']);
            $commentaire->addChild('poids', $value['commentaire_contenu']);
            $commentaire->addChild('lecteurOptique', $value['commentaire_contenu']);
            $commentaire->addChild('supportVideo', $value['commentaire_contenu']);
            $commentaire->addChild('bluetooth', $value['commentaire_contenu']);
            $commentaire->addChild('wifi', $value['commentaire_contenu']);
            $commentaire->addChild('manette', $value['commentaire_contenu']);
            $commentaire->addChild('alimentation', $value['commentaire_contenu']);
            $commentaire->addChild('stockage', $value['commentaire_contenu']);
        }
    }

    public function media($data, $parent)
    {
        $medias = $parent->addChild('medias');
        $data[] =  ['media_type' => 'audio', 'media_contenu' => 'image'];
        $data[] =  ['media_type' => 'video', 'media_contenu' => 'url youtube'];

        foreach ($data as $key => $value) {
            $media = $medias->addChild('media', $value['media_contenu']);
            $media->addAttribute('type', $value['media_type']);
        }
    }

    public function commentaire($data, $parent)
    {
        $commentaires = $parent->addChild('commentaires');
       // $data[] =  ['commentaire_utilisateur' => 'BeerFr0mHell', 'commentaire_date' => '2014-11-21', 'commentaire_note' => '18', 'commentaire_contenu' => 'rockstartgames.com'];
       // $data[] =  ['commentaire_utilisateur' => 'BeerFr0mHell', 'commentaire_date' => '2014-11-21', 'commentaire_note' => '18', 'commentaire_contenu' => 'rockstartgames.com'];

        $str = ['commentaire_utilisateur' => 'utilisateur', 'commentaire_date' => 'date', 'commentaire_note' => 'note', 'commentaire_contenu' => 'contenu'];
        //foreach ($data as $key => $value) {
        //    die(var_dump($value));
            $commentaire = $commentaires->addChild('commentaire');
         //   $commentaire->addChild('utilisateur', $value['commentaire_utilisateur']);
            $commentaire->addChild('date', $data['commentaire_date']);
            $commentaire->addChild('note', $data['commentaire_note']);
            $commentaire->addChild('contenu', $data['commentaire_contenu']);
        //}
    }

    public function editeur($data, $parent)
    {
        $editeurs = $parent->addChild('editeurs');
        /*
        $data[] =  ['editeur_nom' => 'RockstarGames', 'editeur_annee_creation' => '1998', 'editeur_pays' => 'USA', ' editeur_site_web' => 'rockstartgames.com', 'editeur_fondateur' => 'Sam Houser'];
        $data[] =  ['editeur_nom' => 'Take-Two Interctive', 'editeur_annee_creation' => '1993', 'editeur_pays' => 'USA', ' editeur_site_web' => 'take2games.com', 'editeur_fondateur' => 'Ryan Brant'];
        */

        $str = ['editeur_nom' => 'nom', 'editeur_annee_creation' => 'anneeCreation', 'editeur_pays' => 'pays', ' editeur_site_web' => 'sitewebediteur', 'editeur_fondateur' => 'fondateur'];

        foreach ($data as $key => $value) {
            $editeur = $editeurs->addChild('editeur');
            foreach ($value as $key => $pcdata) {
                if(isset($str[$key]))
                    $editeur->addChild((string) $str[$key], $pcdata);
            }
        }
    }

    public function genre($data, $parent)
    {
        $genres = $parent->addChild('genres');

        foreach ($data as $key => $value) {
            $genres->addChild('genre', $value['genre_libelle']);
        }
    }

    public function theme($data, $parent)
    {
        $themes = $parent->addChild('themes');

        foreach ($data as $key => $value) {
            $themes->addChild('theme', $value['theme_libelle']);
        }
    }

    public function support($data, $parent)
    {
        $supports = $parent->addChild('supports');

        foreach ($data as $key => $value) {
            $supports->addChild('support', $value['support_libelle']);
        }
    }

    public function mode($data, $parent)
    {
        $modes = $parent->addChild('modes');

        foreach ($data as $key => $value) {
            $modes->addChild('mode', $value['mode_libelle']);
        }
    }
}
