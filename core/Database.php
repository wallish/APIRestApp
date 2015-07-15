<?php

class Database extends PDO
{
    private  $host = null;
    private  $db = null;
    private  $user = null;
    private  $password = null;
    private static $instance = null;

    public function __construct($options = null)
    {
        $this->host = $GLOBALS['config']['database.host'];
        $this->db = $GLOBALS['config']['database.db'];
        $this->user = $GLOBALS['config']['database.user'];
        $this->password = $GLOBALS['config']['database.password'];

        try{
             parent::__construct('mysql:host='.$this->host.';dbname='.$this->db,
        $this->user,
        $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
         } catch (PDOException $e){
            echo 'Échec lors de la connexion : ' . $e->getMessage();
         }
       
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
