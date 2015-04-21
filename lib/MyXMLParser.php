<?php

class MyXMLParser
{
    public function generate()
    {
        //init => root
        $gamesXML = new SimpleXMLElement('<catalogue></catalogue>');
		$games = $gamesXML->addChild('jeu');
		$games->addAttribute('jeuId', '1');
		$games->addChild('titre', 'Grand Theft Auto V');
        $this->editeur(null,$games);
        $this->console(null,$games);
        $games->addChild('description', 'blablabla');
        $games->addChild('siteweb', 'www.toto.com');
        $this->genre(null,$games);
        $this->theme(null,$games);
        $this->support(null,$games);
		$this->mode(null,$games);

		Header('Content-type: text/xml');
        return $gamesXML->asXML();
    }

    public function console($data, $parent)
    {
        $consoles = $parent->addChild('consoles');

        $data[] = [
            'jeu_console_date_sortie' => '2015-04-14',
            'jeu_console_classification' => '+18 ans',
            'console_nom' => 'SONY PS4',
            'console_date_sortie' => '2013-11-13',
            'jeu_console_prix' => '69.99',
            'console_prix' => '389.90'

        ];

        $data[] = [
            'jeu_console_date_sortie' => '2015-04-14',
            'jeu_console_classification' => '+18 ans',
            'console_nom' => 'SONY PS4',
            'console_date_sortie' => '2013-11-13',
            'jeu_console_prix' => '69.99',
            'console_prix' => '389.90'
        ];


        foreach ($data as $key => $value) {
            $console = $consoles->addChild('console');
            $console->addAttribute('dateSortieJeu', $value['jeu_console_date_sortie']);
            $console->addAttribute('classification', $value['jeu_console_classification']);
            $console->addChild('nomConsole', $value['console_nom']);
            $console->addChild('dateDeSortie', $value['console_date_sortie']);
            $attri = $console->addChild('prixJeu', $value['jeu_console_prix']);
            $attri->addAttribute('devise','€');
            $attri = $console->addChild('prix', $value['console_prix']);
            $attri->addAttribute('devise','€');
            $this->media(null, $console);
            $this->commentaire(null, $console);

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
            $media = $medias->addChild('media',$value['media_contenu']);
            $media->addAttribute('type',$value['media_type']);

        }
    }

    public function commentaire($data, $parent)
    {
        $commentaires = $parent->addChild('commentaires');
        $data[] =  ['commentaire_utilisateur' => 'BeerFr0mHell', 'commentaire_date' => '2014-11-21', 'commentaire_note' => '18', 'commentaire_contenu' => 'rockstartgames.com'];
        $data[] =  ['commentaire_utilisateur' => 'BeerFr0mHell', 'commentaire_date' => '2014-11-21', 'commentaire_note' => '18', 'commentaire_contenu' => 'rockstartgames.com'];

        $str = ['commentaire_utilisateur' => 'utilisateur', 'commentaire_date' => 'date', 'commentaire_note' => 'note', 'commentaire_contenu' => 'contenu'];

        foreach ($data as $key => $value) {
            $commentaire = $commentaires->addChild('commentaire');
            $commentaire->addChild('utilisateur', $value['commentaire_utilisateur']);
            $commentaire->addChild('date', $value['commentaire_date']);
            $commentaire->addChild('note', $value['commentaire_note']);
            $commentaire->addChild('contenu', $value['commentaire_contenu']);
          
        }
    }


    public function editeur($data, $parent)
    {
        $editeurs = $parent->addChild('editeurs');
        $data[] =  ['editeur_nom' => 'RockstarGames', 'editeur_annee_creation' => '1998', 'editeur_pays' => 'USA', ' editeur_site_web' => 'rockstartgames.com', 'editeur_fondateur' => 'Sam Houser'];
        $data[] =  ['editeur_nom' => 'Take-Two Interctive', 'editeur_annee_creation' => '1993', 'editeur_pays' => 'USA', ' editeur_site_web' => 'take2games.com', 'editeur_fondateur' => 'Ryan Brant'];

        $str = ['editeur_nom' => 'nom', 'editeur_annee_creation' => 'anneeCreation', 'editeur_pays' => 'pays', ' editeur_site_web' => 'sitewebediteur', 'editeur_fondateur' => 'fondateur'];

        foreach ($data as $key => $value) {
            $editeur = $editeurs->addChild('editeur');
            foreach ($value as $key => $pcdata) {
                $editeur->addChild((string)$str[$key], $pcdata);
            }
        }
    }

    public function genre($data, $parent)
    {
        $genres = $parent->addChild('genres');
        $data = [0 => 'Action', 1 => 'FPS', 2 => 'TPS'];

        foreach ($data as $key => $value) {
            $genres->addChild('genre', $value);
        }
    }

    public function theme($data, $parent)
    {
        $themes = $parent->addChild('themes');
        $data = [0 => 'Contemporain', 1 => 'Amérique du nord'];

        foreach ($data as $key => $value) {
            $themes->addChild('theme', $value);
        }
    }

    public function support($data, $parent)
    {
    	$supports = $parent->addChild('supports');
    	$data = [0 => 'Online', 1 => 'DVD', 2 => 'Blu-Ray', 3 => 'Playstation Store', 4 => 'Contenu Xbox Live'];

    	foreach ($data as $key => $value) {
    		$supports->addChild('support', $value);
    	}
    }

    public function mode($data, $parent)
    {
        $modes = $parent->addChild('modes');
        $data = [0 => 'Jouable en solo', 1 => 'Multi en ligne'];

        foreach ($data as $key => $value) {
            $modes->addChild('mode', $value);
        }
    }


}
