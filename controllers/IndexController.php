<?php

class IndexController extends Controller {

	public function __construct() {
        
    }

	public function indexAction()
	{
		
		$foo = User::getInstance()->fetchEntry('username','foobar');
		
		echo "<pre>";
		var_dump($foo);
var_dump($_SERVER);
		die('IndexController/Index');
	}

}