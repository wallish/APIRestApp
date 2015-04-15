<?php

class ConsoleController {

	public function indexAction($request = null)
	{
		var_dump($request);
		die('ConsoleController/Index');
	}

	public function testAction()
	{
		die('ConsoleController/Test');
	}

}