<?php

$gamesXML = new SimpleXMLElement('<games></games>');
$games = $gamesXML->addChild('game');
$games->addAttribute('type', 'hack\n slash');
$games->addAttribute('id', '2');
$games->addChild('title', 'Diablo 3');
$games->addChild('editeur', 'Blizzard');

Header('Content-type: text/xml');
echo $gamesXML->asXML();
die();
