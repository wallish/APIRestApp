<?php

$user = 'foobar';
$api = 'bar';
$api_secret = 'foo';
$id = '1';

$sig = hash_hmac('sha256', $user.$id.$api_secret.time(), $api);

// ouverture de la connection
$ch = curl_init();
$url = 'http://localhost/apirestapp/game/add/';

// set post
$fields = array(
				'game' => array(
                	'jeu_titre' => 'sf4',
                	'jeu_description' => 'jeu de combat',
                	'jeu_site_web' => 'www.foo.com',
                ),
            );

$to_merge = array(
	'media' =>  array(
		'media_url' => 'http://www.jeux-consoles.net/img/9729_mario_sonic.jpg', 
		'media_media_type_id' => 1
		),
	'console' => array(
		'console_nom' => 'Console Test',
		'console_date_sortie' => '2013-11-22 00:00:00',
		'console_prix' => "100"
		),
	'caracteristique' => array(
		'console_nom' => 'Console Test',
		'console_date_sortie' => '2013-11-22 00:00:00',
		'console_prix' => "100"
		),
	'console_caracteristique' => array(
		array('console_caracteristique_caracteristique_id' => 1, 'console_caracteristique_valeur' => "static cpu"),
		array('console_caracteristique_caracteristique_id' => 2, 'console_caracteristique_valeur' => "static gpu"),
		array('console_caracteristique_caracteristique_id' => 3, 'console_caracteristique_valeur' => "static ram"),
		array('console_caracteristique_caracteristique_id' => 4, 'console_caracteristique_valeur' => "static kg"),
		array('console_caracteristique_caracteristique_id' => 5, 'console_caracteristique_valeur' => "static lecteur"),
		array('console_caracteristique_caracteristique_id' => 6, 'console_caracteristique_valeur' => "static hd"),
		array('console_caracteristique_caracteristique_id' => 7, 'console_caracteristique_valeur' => "static Bluetooth"),
		array('console_caracteristique_caracteristique_id' => 8, 'console_caracteristique_valeur' => "static wifi"),
		array('console_caracteristique_caracteristique_id' => 9, 'console_caracteristique_valeur' => "static usb"),
		array('console_caracteristique_caracteristique_id' => 10, 'console_caracteristique_valeur' => "static manette"),
		array('console_caracteristique_caracteristique_id' => 11, 'console_caracteristique_valeur' => "static volt"),
		array('console_caracteristique_caracteristique_id' => 12, 'console_caracteristique_valeur' => "static go"),
		),
	'commentaire' => array(
		array(
			'commentaire_utilisateur' => 'static user', 
			'commentaire_date' => date('Y-m-d'),
			'commentaire_note' => 18, 
			'commentaire_contenu' => 'static comment'
		),
	),
	'jeu_console' => array(
		'jeu_console_date_sortie' => '2015-11-18 00:00:00', 
		'jeu_console_prix' => '50', 
		'jeu_console_classification' => '+3'
		),
);

$mergeData = array_merge($fields,$to_merge);

// set les options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_POST, count($mergeData));
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($mergeData));
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

	