<?php


/*
api secret admin = jhJBbjBOM64S6f
api secret  user = odzaknddDJZ5DZ5
*/
/*
$user = 'admin';
$api = '123456789';
$api_secret = 'jhJBbjBOM64S6f';
*/
$user = 'user';
$api = '123456789';
$api_secret = 'odzaknddDJZ5DZ5';

$sig = hash_hmac('sha256', $user.$api_secret.time(), $api);

// ouverture de la connection
$ch = curl_init();
$url = 'http://localhost/apirestapp/game/get/id/';

// set les options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_TIMEOUT, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('HEADERSIGNATURE:'.$sig, 'HEADERUSER:'.$user, 'HOST:localhost'));

// exec le curl
$head = curl_exec($ch);
/*echo curl_getinfo($ch) . '<br/>';
echo curl_errno($ch) . '<br/>';
echo curl_error($ch) . '<br/>';*/
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
