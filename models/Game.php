<?php

class Game extends Model
{
    public $string;
    private static $instance = null;
    private static $adapter = null;
    private $table = 'user';

    public function __construct()
    {
        parent::__construct();
        self::$adapter = parent::getAdapter();
    }

    public function getAdapter()
    {
        return self::$adapter;
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function fetchEntry($field, $search)
    {
        $reponse = $this->getAdapter()->prepare('SELECT * FROM '.$this->table.' where '.$field.' = :'.$field);
        $reponse->execute(array(':'.$field => $search));

        return $reponse->fetchAll();
    }

    public function fetchAll($query = null)
    {
        $reponse = $this->getAdapter()->prepare('SELECT * FROM '.$this->table);
        $reponse->execute();

        return $reponse->fetchAll();
    }

    public function delete($id)
    {
        /* $reponse = $this->getAdapter()->prepare('DELETE * FROM '.$this->table' where id = :id ');
        $reponse->execute(array(':id'=> $id));

        return $reponse->fetchAll();*/
    }

    public function save(array $data)
    {
        $reponse = $this->getAdapter()->prepare('DESCRIBE '.$this->table);
        $reponse->execute();

        return $reponse->fetchAll(PDO::FETCH_COLUMN);

        //"INSERT INTO MyGuests (firstname, lastname, email) VALUES ('John', 'Doe', 'john@example.com)";
    }
}
