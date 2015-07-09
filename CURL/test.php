<?php
/*
$context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
$url = "http://localhost/apirestapp/game/get/id/2";
$xml = file_get_contents($url, false, $context);
$xml = simplexml_load_string($xml);

$oXML = new SimpleXMLElement($xml);
die(var_dump($oXML));
$result = $xml->xpath("jeu");

print_r($result);*/

function download_page($path){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$path);
	curl_setopt($ch, CURLOPT_FAILONERROR,1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 15);
	$retValue = curl_exec($ch);			 
	curl_close($ch);
	return $retValue;
}

$sXML = download_page("http://localhost/apirestapp/game/get/id/2");
$oXML = new SimpleXMLElement($sXML);
die(var_dump($oXML));
foreach($oXML->entry as $oEntry){
	echo $oEntry->title . "\n";
}
?> 