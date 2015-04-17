<?php

class Database extends PDO {

	const  PARAM_HOST = "localhost";
	const  PARAM_DB = "api";
	const  PARAM_USER = "root";
	const  PARAM_PASSWORD = "";
	private static $instance = null;
 
    public function __construct($options=null){
        parent::__construct('mysql:host='.Database::PARAM_HOST.';dbname='.Database::PARAM_DB,
		Database::PARAM_USER,
		Database::PARAM_PASSWORD,$options);
    }

	public static function getInstance()
	{  
		if(is_null(self::$instance))
		{
			self::$instance = new Database();
		}
	    return self::$instance;
	}


    public function query($query){ 
        $args = func_get_args();
        array_shift($args); 

        $reponse = parent::prepare($query);
        $reponse->execute($args);
        //return $stmt->fetchAll();
        return $reponse;
    }

}