<?php

class Security {

	public static function verify()
	{
		$sighhttp = $_SERVER['HTTP_HEADERSIGNATURE'];
		$userhttp = $_SERVER['HTTP_HEADERUSER'];
		$hosthttp = $_SERVER['HTTP_HOST'];

		$sig = hash_hmac("sha256", $user.$id.$secret, $api);

		if($signhttp == $sig)
		{
			header('HTTP/1. 200 OK');
			// afficher le xml & json
		}else {
			header('HTTP/1. 403 OK');
		}
	}
}