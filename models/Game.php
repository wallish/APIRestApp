<?php
class Game extends Model
{
    public $string;
 	private static $instance = null;
 	private static $adapter = null;

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
		if(is_null(self::$instance))
		{
			self::$instance = new Game();
		}
	    return self::$instance;
	}

   public function fetchEntry($id)
   { 
        $args = func_get_args();
        array_shift($args);
      
        $reponse = $this->getAdapter()->prepare('SELECT * FROM game where id = :id');
        $reponse->execute(array(':id' => $id));

        return $reponse->fetchAll();
       //return $reponse;
    }

    public function fetchAll($query = null)
    { 
        $args = func_get_args();
        array_shift($args);
       
        $reponse = $this->getAdapter()->prepare('SELECT * FROM game');
        $reponse->execute();

        return $reponse->fetchAll();
       //return $reponse;
    }
}