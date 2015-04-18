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

    public function getColumns($table)
    {
        $reponse = $this->getAdapter()->prepare('DESCRIBE '.$table);
        $reponse->execute();

        return $reponse->fetchAll(PDO::FETCH_COLUMN);
    }

    public function foobar()
    {
        $array = array();
        $string = 'INSERT INTO users ';
        foreach ($data as $key => $value) {
            $string .= ' '.$value;
            $where .= ' '.$key;
        }
    }
}
