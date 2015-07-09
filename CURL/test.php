<?php
$context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
$url = "http://localhost/apirestapp/game/get/id/2";
$xml = file_get_contents($url, false, $context);
$xml = simplexml_load_string($xml);
$result = $xml->xpath("jeu");

print_r($result);
?> 