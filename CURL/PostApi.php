<?php

$user = 'foobar';
$api = 'bar';
$api_secret = 'foo';
$id = '1';

$sig = hash_hmac('sha256', $user.$id.$api_secret.time(), $api);

// ouverture de la connection
$ch = curl_init();
$url = 'http://myapi.local/game/add/';

// set post
$fields = array(
				'game' => array(
                	'jeu_titre' => urlencode('sf4'),
                	'jeu_description' => urlencode('jeu de combat'),
                	'jeu_site_web' => urlencode('www.foo.com'),
                ),
            );

// set les options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_POST, count($fields));
//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('HEADERSIGNATURE:'.$sig, 'HEADERUSER:'.$user, 'HOST:localhost'));

// exec le curl
$response = curl_exec($ch);
echo curl_getinfo($ch) . '<br/>';
echo curl_errno($ch) . '<br/>';
echo curl_error($ch) . '<br/>';
if (!$response) {
    die('Connection Failure');
}
curl_close($ch);
