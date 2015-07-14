<?php

class Security
{
    public static function verify()
    {
        $api_key = "123456789";

        $sighttp = $_SERVER['HTTP_HEADERSIGNATURE'];
        $userhttp = $_SERVER['HTTP_HEADERUSER'];
        $hosthttp = $_SERVER['HTTP_HOST'];

        // db
        $user = User::getInstance()->fetchEntry(['field' => 'username', 'search' => $userhttp]);
        
        if (!$user) {
            die('user missing');
        }
        $sig = hash_hmac('sha256', $user[0]['username'].$user[0]['api_secret_key'].time(), $api_key);

        

        if ($sighttp == $sig) {
            if(!Acl::checkAcl($user[0]['id'], $_SERVER['REQUEST_METHOD']))
            {
                header('HTTP/1. 403 Unauthorized');
                echo "no rights";
                exit;
            }
            header('HTTP/1. 200 OK');
            echo 'token ok';
        } else {
            header('HTTP/1. 403 Unauthorized');
            echo 'token fail';
            exit;
        }
    }
}
