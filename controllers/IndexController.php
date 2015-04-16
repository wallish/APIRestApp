<?php

class IndexController extends Controller {

	public function __construct() {
        
    }

	public function indexAction()
	{
		/*$db = new Database();
		$db->init();
		$foo = $db->fetchEntry();*/

		
		
		var_dump($_REQUEST);
		die('IndexController/Index');
	}

}