<?php

class Media extends Model
{
    public $string;
    private static $instance = null;
    private static $adapter = null;
    private $table = 'media';
    private $reftable = 'media_type';

    public function __construct()
    {
        parent::__construct();
        self::$adapter = parent::getAdapter();
    }

    public function getAdapter()
    {
        return self::$adapter;
    }

    public function getTable()
    {
        return $this->table;
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function fetchEntry(array $filter)
    {
        $reponse = $this->getAdapter()->prepare('SELECT * FROM '.$this->table.' where '.$filter['field'].' = :'.$filter['field']);
        $reponse->execute(array(':'.$filter['field'] => $filter['search']));

        return $reponse->fetchAll();
    }

    public function fetchAll($consoleId = 1, $jeuId = 1)
    {

        $reponse = $this->getAdapter()->prepare("
            SELECT * 
            FROM ".$this->table.",".$this->reftable."
            WHERE media_media_type_id = media_type_id
            AND media_jeu_console_console_id =".$consoleId."
            AND media_jeu_console_jeu_id =".$jeuId);

        $reponse->execute();

        /*
        SELECT * 
            FROM console, console_caracteristique,caracteristique
            WHERE console_caracteristique_console_id = console_id 
            AND caracteristique_id = console_caracteristique_caracteristique_id 
            AND console_caracteristique_console_id =1
            */

        return $reponse->fetchAll();
    }
}
