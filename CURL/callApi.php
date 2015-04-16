<?php 

$user = "toto";
$api = "foo";
$api_secret = "bar";
$id = "1";
$id = "1";

$sig = hash_hmac("sha256", $user.$id.$api_secret.time(), $api);

// ouverture de la connection
$ch = curl_init(); 

$url = "localhost/api/index/index/id/2";
// set les options
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_TIMEOUT, 1); 
curl_setopt($ch, CURLOPT_TIMEOUT, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER,array('HEADERSIGNATURE:'.$sig,'HEADERUSER:'.$user,'HOST:localhost'));
// exec le curl
$head = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch); 