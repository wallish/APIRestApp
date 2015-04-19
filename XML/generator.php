<?php

$gamesXML = new SimpleXMLElement('<catalogue></catalogue>');
$games = $gamesXML->addChild('jeu');
$games->addAttribute('jeuId', '1');
$games->addChild('titre', 'Grand Theft Auto V');

$editeurs = $games->addChild('editeurs');
$editeur = $editeurs->addChild('editeur');
$editeur->addChild('nom', 'RockstarGames');
$editeur->addChild('anneeCreation', '1998');
$editeur->addChild('pays', 'USA');
$editeur->addChild('sitewebediteur', 'rockstartgames.com');
$editeur->addChild('fondateur', 'Sam Houser');

$editeur = $editeurs->addChild('editeur');
$editeur->addChild('nom', 'Take-Two Interctive');
$editeur->addChild('anneeCreation', '1993');
$editeur->addChild('pays', 'USA');
$editeur->addChild('sitewebediteur', 'take2games.com');
$editeur->addChild('fondateur', 'Ryan Brant');

$games->addChild('description', 'fooobar');
$games->addChild('siteweb', 'fooobar');

$consoles = $games->addChild('consoles');
$console = $consoles->addChild('console');
$console->addAttribute('dateSortieJeu', '2015-04-14');
$console->addAttribute('classification', '+18 ans');

$console->addChild('nomConsole', 'SONY PS4');
$console->addChild('dateDeSortie', '2013-11-13');
$prixjeu = $console->addChild('prixJeu', '69.99');
$prixjeu->addAttribute('devise', 'EUR');

$prix = $console->addChild('prix', '389.90');
$prix->addAttribute('devise', 'EUR');

//debut caracteristiques
$caracteristiques = $console->addChild('caracteristiques');
$caracteristiques->addChild('cpu', 'X86-64 AMD Jaguar 8 coeurs');
$caracteristiques->addChild('gpu', 'AMD Radeon 1.84 TFlop');
$caracteristiques->addChild('ram', '8 Go de RAM GDDR5');
$caracteristiques->addChild('poids', '2.8 kg');
$caracteristiques->addChild('lecteurOptique', 'Blu-ray X6 - DVD X8');
$caracteristiques->addChild('supportVideo', 'Ultra HD');
$caracteristiques->addChild('bluetooth', 'Bluetooth 2.0');
$caracteristiques->addChild('wifi', 'WiFi 802.11 b/g/n');
$caracteristiques->addChild('portUsb', '3.0');
$caracteristiques->addChild('manette', 'DualShock 4');
$caracteristiques->addChild('alimentation', 'AC 220 - 240 V, 50 / 60 Hz');
$caracteristiques->addChild('stockage', '500go');
//fin caracteristiques

//debut medias
$medias = $console->addChild('medias');
$media = $medias->addChild('media');
$media->addAttribute('type', 'image');
$media = $medias->addChild('media');
$media->addAttribute('type', 'video');
// fin medias

// debut commentaires
$commentaires = $console->addChild('commentaires');
$commentaire = $commentaires->addChild('commentaire');
$commentaire->addChild('utilisateur', 'BeerFr0mHell');
$commentaire->addChild('date', '2014-11-21');
$commentaire->addChild('note', '18');
$commentaire->addChild('contenu', 'fooobar');

$commentaire = $commentaires->addChild('commentaire');
$commentaire->addChild('utilisateur', 'BeerFr0mHell');
$commentaire->addChild('date', '2014-11-21');
$commentaire->addChild('note', '18');
$commentaire->addChild('contenu', 'fooobar');

$commentaire = $commentaires->addChild('commentaire');
$commentaire->addChild('utilisateur', 'profusions');
$commentaire->addChild('date', '2014-11-21');
$commentaire->addChild('note', '18');
$commentaire->addChild('contenu', 'fooobar');

$commentaire = $commentaires->addChild('commentaire');
$commentaire->addChild('utilisateur', 'FireGhost93');
$commentaire->addChild('date', '2014-11-21');
$commentaire->addChild('note', '18');
$commentaire->addChild('contenu', 'fooobar');
// fin commentaires

// debut console 2
$console = $consoles->addChild('console');
$console->addAttribute('dateSortieJeu', '2015-04-14');
$console->addAttribute('classification', '+18 ans');

$console->addChild('nomConsole', 'SONY PS4');
$console->addChild('dateDeSortie', '2013-11-13');
$prixjeu = $console->addChild('prixJeu', '69.99');
$prixjeu->addAttribute('devise', 'EUR');

$prix = $console->addChild('prix', '389.90');
$prix->addAttribute('devise', 'EUR');

//debut caracteristiques
$caracteristiques = $console->addChild('caracteristiques');
$caracteristiques->addChild('cpu', 'X86-64 AMD Jaguar 8 coeurs');
$caracteristiques->addChild('gpu', 'AMD Radeon 1.84 TFlop');
$caracteristiques->addChild('ram', '8 Go de RAM GDDR5');
$caracteristiques->addChild('poids', '2.8 kg');
$caracteristiques->addChild('lecteurOptique', 'Blu-ray X6 - DVD X8');
$caracteristiques->addChild('supportVideo', 'Ultra HD');
$caracteristiques->addChild('bluetooth', 'Bluetooth 2.0');
$caracteristiques->addChild('wifi', 'WiFi 802.11 b/g/n');
$caracteristiques->addChild('portUsb', '3.0');
$caracteristiques->addChild('manette', 'DualShock 4');
$caracteristiques->addChild('alimentation', 'AC 220 - 240 V, 50 / 60 Hz');
$caracteristiques->addChild('stockage', '500go');
//fin caracteristiques

//debut medias
$medias = $console->addChild('medias');
$media = $medias->addChild('media');
$media->addAttribute('type', 'image');
$media = $medias->addChild('media');
$media->addAttribute('type', 'video');
// fin medias

$console = $consoles->addChild('console');
$console->addAttribute('dateSortieJeu', '2015-04-14');
$console->addAttribute('classification', '+18 ans');

$console->addChild('nomConsole', 'SONY PS4');
$console->addChild('dateDeSortie', '2013-11-13');
$prixjeu = $console->addChild('prixJeu', '69.99');
$prixjeu->addAttribute('devise', 'EUR');

$prix = $console->addChild('prix', '389.90');
$prix->addAttribute('devise', 'EUR');

//debut caracteristiques
$caracteristiques = $console->addChild('caracteristiques');
$caracteristiques->addChild('cpu', 'X86-64 AMD Jaguar 8 coeurs');
$caracteristiques->addChild('gpu', 'AMD Radeon 1.84 TFlop');
$caracteristiques->addChild('ram', '8 Go de RAM GDDR5');
$caracteristiques->addChild('poids', '2.8 kg');
$caracteristiques->addChild('lecteurOptique', 'Blu-ray X6 - DVD X8');
$caracteristiques->addChild('supportVideo', 'Ultra HD');
$caracteristiques->addChild('bluetooth', 'Bluetooth 2.1');
$caracteristiques->addChild('wifi', 'WiFi 802.11 b/g/n');
$caracteristiques->addChild('portUsb', '2.0');
$caracteristiques->addChild('manette', 'Sixaxis - DualShock 3');
$caracteristiques->addChild('alimentation', 'AC 220 - 240 V, 50 / 60 Hz');
$caracteristiques->addChild('stockage', '500go');
//fin caracteristiques

//debut medias
$medias = $console->addChild('medias');
$media = $medias->addChild('media');
$media->addAttribute('type', 'image');
$media = $medias->addChild('media');
$media->addAttribute('type', 'video');
// fin medias

// genres
$genres = $games->addChild('genres');
$genres->addChild('genre', 'Action');
$genres->addChild('genre', 'FPS');
$genres->addChild('genre', 'TPS');

// themes
$themes = $games->addChild('themes');
$themes->addChild('theme', 'Contemporain');
$themes->addChild('theme', 'Amérique du nord');

// supports
$supports = $games->addChild('supports');
$supports->addChild('support', 'Online');
$supports->addChild('support', 'DVD');
$supports->addChild('support', 'Blu-Ray');
$supports->addChild('support', 'Playstation Store');
$supports->addChild('support', 'Contenu Xbox Live');

// modes
$modes = $games->addChild('modes');
$modes->addChild('mode', 'Jouable en solo');
$modes->addChild('mode', 'Multi en ligne');

Header('Content-type: text/xml');
echo $gamesXML->asXML();
die();
