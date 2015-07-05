<?php

class Mode extends Model
{
    public $string;
    private static $instance = null;
    private static $adapter = null;
    private $table = 'mode';

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

    public function fetchAll($jeuId = 1, $consoleId = 1)
    {
        $reponse = $this->getAdapter()->prepare("
            SELECT * FROM ".$this->table."
            WHERE jeu_mode_jeu_id =".$jeuId

        );

        $reponse->execute();

        return $reponse->fetchAll();
    }
}
