<?php

class Database extends PDO
{
    const  PARAM_HOST = 'localhost';
    const  PARAM_DB = 'api';
    const  PARAM_USER = 'root';
    const  PARAM_PASSWORD = '';
    private static $instance = null;

    public function __construct($options = null)
    {
        parent::__construct('mysql:host='.self::PARAM_HOST.';dbname='.self::PARAM_DB,
        self::PARAM_USER,
        self::PARAM_PASSWORD, $options);
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function query($query)
    {
        $args = func_get_args();
        array_shift($args);

        $reponse = parent::prepare($query);
        $reponse->execute($args);
        //return $stmt->fetchAll();
        return $reponse;
    }
}
