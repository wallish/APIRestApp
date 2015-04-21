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
        $data[] =  ['editeur_nom' => 'RockstarGames', 'editeur_annee_creation' => '1998', 'editeur_pays' => 'USA', ' editeur_site_web' => 'rockstartgames.com', 'editeur_fondateur' => 'Sam Houser'];
        $data[] =  ['editeur_nom' => 'Take-Two Interctive', 'editeur_annee_creation' => '1993', 'editeur_pays' => 'USA', ' editeur_site_web' => 'take2games.com', 'editeur_fondateur' => 'Ryan Brant'];

        $str = ['editeur_nom' => 'nom', 'editeur_annee_creation' => 'anneeCreation', 'editeur_pays' => 'pays', ' editeur_site_web' => 'sitewebediteur', 'editeur_fondateur' => 'fondateur'];

        foreach ($data as $key => $value) {
            $console = $consoles->addChild('editeur');
            foreach ($value as $key => $pcdata) {
                $console->addChild((string)$str[$key], $pcdata);
            }
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
