<?php

class Request
{
    public static function isPost()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return true;
        } else {
            return false;
        }
    }

    public static function isGet()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            return true;
        } else {
            return false;
        }
    }

    public static function isPut()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            return true;
        } else {
            return false;
        }
    }

    public static function isDelete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            return true;
        } else {
            return false;
        }
    }

    public static function isJson($string)
    {
        json_decode($string);

        return (json_last_error() == JSON_ERROR_NONE);
    }

    public static function getValues()
    {
    }
}
