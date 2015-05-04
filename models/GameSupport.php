<?php

class GameSupport extends Model
{
    public $string;
    private static $instance = null;
    private static $adapter = null;
    private $table = 'jeu_support';
    private $reftable = 'support';

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
            WHERE jeu_support_support_id = support_id 
            AND jeu_support_jeu_id =".$query
        );

        $reponse->execute();

        return $reponse->fetchAll();
    }
}
