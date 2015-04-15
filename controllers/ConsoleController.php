<?php

class ConsoleController extends Controller {

 	public function __construct() {
        
    }

	public function indexAction($request = null)
	{
		$foo = Console::getInstance()->fetchEntry(1);
		var_dump($foo);
		die('ConsoleController/Index');
	}

	public function testAction()
	{
		die('ConsoleController/Test');
	}

}