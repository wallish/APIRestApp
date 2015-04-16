<?php

class IndexController extends Controller {

	public function __construct() {
        
    }

	public function indexAction()
	{
		
		$foo = User::getInstance()->fetchEntry('username','foobar');
		
		echo "<pre>";
		var_dump($foo);

		die('IndexController/Index');
	}

}