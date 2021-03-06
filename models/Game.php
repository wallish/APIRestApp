<?php

class Game extends Model
{
    public $string;
    private static $instance = null;
    private static $adapter = null;
    private $table = 'jeu';

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
            SELECT * FROM ".$this->table."
            WHERE jeu_id =".$query." AND deleted = 0"
        );

        $reponse->execute();

        return $reponse->fetchAll();
    }

    public function fetchList()
    {
        $reponse = $this->getAdapter()->prepare("
            SELECT * FROM ".$this->table." WHERE deleted != 1"
            
        );

        $reponse->execute();

        return $reponse->fetchAll();
    }

    public function desactivate($id)
    {
        if(!$id) die("missing parameter");
        $reponse = $this->getAdapter()->prepare("
            UPDATE ".$this->table." SET deleted = 1 WHERE jeu_id=".$id
            
        );

        $reponse->execute();

        //return $reponse->fetchAll();
    }
}
