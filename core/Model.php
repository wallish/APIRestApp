<?php
class Model extends Database
{
    public $string;
    private static $adapter;
 
    public function __construct()
    {
        self::$adapter = Database::getInstance();
       
    }

    public function getAdapter()
    {
    	return self::$adapter;
    }
}