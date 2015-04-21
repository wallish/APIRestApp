<?php

class Security
{
    public static function verify()
    {
        /*$sighttp = "";
        $sign = "";
        $controller = explode('/', $_SERVER['REQUEST_URI']);
        $exeptionController = array('index');*/

        /*if(!in_array($controller[2], $exeptionController)) {*/

        $sighttp = $_SERVER['HTTP_HEADERSIGNATURE'];
        $userhttp = $_SERVER['HTTP_HEADERUSER'];
        $hosthttp = $_SERVER['HTTP_HOST'];

        // db
        $user = User::getInstance()->fetchEntry(['field' => 'username', 'search' => $userhttp]);

        if (!$user) {
            die('user missing');
        }
        $sig = hash_hmac('sha256', $user[0]['username'].$user[0]['id'].$user[0]['api_secret_key'].time(), $user[0]['api_key']);
       /* }*/

        /*if (in_array($controller[2], $exeptionController)) {
            header('HTTP/1. 200 OK');
            // afficher le xml & json
        }
        else */
        if ($sighttp == $sig) {
            header('HTTP/1. 200 OK');
            echo 'token ok';
        } else {
            header('HTTP/1. 403 Unauthorized');
            echo 'token fail';
            exit;
        }
    }
}
