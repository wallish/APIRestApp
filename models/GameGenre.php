<?php

class GameGenre extends Model
{
    public $string;
    private static $instance = null;
    private static $adapter = null;
    private $table = 'jeu_genre';
    private $reftable = 'genre';

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

    public function fetchAll($query = 1)
    {
        $reponse = $this->getAdapter()->prepare("
            SELECT * FROM ".$this->table.",".$this->reftable."
            WHERE jeu_genre_genre_id = genre_id 
            AND jeu_genre_jeu_id =".$query
        );

        $reponse->execute();

        return $reponse->fetchAll();
    }
}
