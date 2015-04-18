<?php

class Security
{
    public static function verify()
    {
        $sighttp = $_SERVER['HTTP_HEADERSIGNATURE'];
        $userhttp = $_SERVER['HTTP_HEADERUSER'];
        $hosthttp = $_SERVER['HTTP_HOST'];

        // hardcode
        /*$user = "toto";
        $api = "foo";
        $api_secret = "bar";
        $id = "1";*/

        // db
        $user = User::getInstance()->fetchEntry('username', $userhttp);

        $sig = hash_hmac('sha256', $user[0]['username'].$user[0]['id'].$user[0]['api_secret_key'].time(), $user[0]['api_key']);

        if ($sighttp == $sig) {
            header('HTTP/1. 200 OK');
            // afficher le xml & json
            echo 'token ok';
        } else {
            header('HTTP/1. 403 OK');
            echo 'token failed';
            exit;
        }
    }
}
