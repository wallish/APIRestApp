<?php

class Curl {

	//private $ch;
	private $user;
	private $api;
	private $secret;
	private $sig;

	public function __construct($user, $api, $secret ){
		$this->user = $user; //'foobar';
		$this->api = $api; //'bar';
		$this->secret = $secret; //'foo';
		$this->sig = hash_hmac('sha256', $user.$secret.time(), $api);
		
	}

	public function getForm($id = null) {
		$url = "http://myapi.local:8888/index/getform/id/";
		if($id != "undefined") $url .= $id;
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FAILONERROR,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 15);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('HEADERSIGNATURE:'.$this->sig, 'HEADERUSER:'.$this->user, 'HOST:localhost'));

		$response = curl_exec($ch);

		curl_close($ch);

		return $response;
	}

	public function delete($id){
		$url = 'http://myapi.local:8888/game/delete/';

		$ch = curl_init();
		// set post
		$fields = array(
		                'id' => $id, // TODO : sécurité => remplacer id par une key
		            );

		// set les options
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
		curl_setopt($ch, CURLOPT_POST, count($fields));
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('HEADERSIGNATURE:'.$this->sig, 'HEADERUSER:'.$this->user, 'HOST:localhost'));

		// exec le curl
		$response = curl_exec($ch);

		curl_close($ch);

		return $response;
	}

	public function get($id = null) {

		$ch = curl_init();
		$url = 'http://myapi.local:8888/game/get/id';

		// set les options
		
		
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_FAILONERROR,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 15);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('HEADERSIGNATURE:'.$this->sig, 'HEADERUSER:'.$this->user, 'HOST:localhost'));

		// exec le curl
		$result = curl_exec($ch);
		/*echo curl_getinfo($ch) . '<br/>';
		echo curl_errno($ch) . '<br/>';
		echo curl_error($ch) . '<br/>';*/
		//$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		//var_dump($head);
		curl_close($ch);

		return $result;

	}

	public function put(){
		$ch = curl_init();
		$url = 'http://myapi.local:8888/game/update/';

		// set post
		$fields = array(
				'game' => array(
					'jeu_id' => $_POST['jeu_id'],
                	'jeu_titre' => $_POST['jeu_titre'],
                	'jeu_description' => $_POST['jeu_description'],
                	'jeu_site_web' => $_POST['jeu_siteweb'],
                ),
            );

		/*echo "<pre>".print_r($_POST,true)."</pre>";
		exit;*/

		// set les options
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($ch, CURLOPT_POST, count($fields));
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('HEADERSIGNATURE:'.$this->sig, 'HEADERUSER:'.$this->user, 'HOST:localhost'));

		// exec le curl
		$response = curl_exec($ch);
	
		curl_close($ch);

		header("Location:/Api-website/");
	}

	public function post(){
		$ch = curl_init();
		$url = 'http://myapi.local:8888/game/add/';

		// set post
		$fields = array(
				'game' => array(
                	'jeu_titre' => $_POST['jeu_titre'],
                	'jeu_description' => $_POST['jeu_description'],
                	'jeu_site_web' => $_POST['jeu_siteweb'],
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
			'mode' => array('mode_id' => 1),
			'editeur' => array('editeur_id' => 1),
			'theme' => array('theme_id' => 1),
			'support' => array('support_id' => 1),
			'genre' => array('genre_id' => 1),
		);
		$mergeData = array_merge($fields,$to_merge);
		
		// set les options
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_POST, count($mergeData));
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($mergeData));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('HEADERSIGNATURE:'.$this->sig, 'HEADERUSER:'.$this->user, 'HOST:localhost'));

		// exec le curl
		$response = curl_exec($ch);
		
		curl_close($ch);

		header("Location:/Api-website/");
	}
}