<?php

$user = 'foobar';
$api = 'bar';
$api_secret = 'foo';
$id = '1';

$sig = hash_hmac('sha256', $user.$id.$api_secret.time(), $api);

// ouverture de la connection
$ch = curl_init();
$url = 'localhost/api/game/add/';

// set post
$fields = array(
                'name' => urlencode('toto'),
            );

// set les options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_TIMEOUT, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
curl_setopt($ch, CURLOPT_POST, count($fields));
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('HEADERSIGNATURE:'.$sig, 'HEADERUSER:'.$user, 'HOST:localhost'));

// exec le curl
$response = curl_exec($ch);
if (!$response) {
    die('Connection Failure.n');
}
curl_close($ch);
