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

	public function put($id){
		$ch = curl_init();
		$url = 'http://myapi.local:8888/game/update/';

		// set post
		$fields = array(
		                'id' => 9,
		                'password' => 'update',
		            );

		// set les options
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($ch, CURLOPT_POST, count($fields));
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('HEADERSIGNATURE:'.$this->sig, 'HEADERUSER:'.$this->user, 'HOST:localhost'));

		// exec le curl
		$response = curl_exec($ch);
	
		curl_close($ch);

		return $response;
	}

	public function post(){
		$ch = curl_init();
		$url = 'http://myapi.local:8888/game/add/';

		// set post
		$fields = array(
		                'username' => urlencode('nirun'),
		                'password' => urlencode('than'),
		            );

		// set les options
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
		curl_setopt($ch, CURLOPT_POST, count($fields));
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('HEADERSIGNATURE:'.$this->sig, 'HEADERUSER:'.$this->user, 'HOST:localhost'));

		// exec le curl
		$response = curl_exec($ch);
		
		curl_close($ch);

		return $response;
	}
}