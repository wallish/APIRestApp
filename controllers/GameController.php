<?php

class GameController extends Controller {

 	public function __construct() {
        
    }

	public function indexAction($request = null)
	{
				
		var_dump($_REQUEST);
		die('GameController/Index');
	}

	public function testAction()
	{
		die('GameController/Test');
	}

	public function addAction()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			var_dump($_REQUEST);
		}

		die('GameController/add');
	}

	public function deleteAction()
	{
		if($_SERVER['REQUEST_METHOD'] == 'DELETE')
		{
			parse_str(file_get_contents("php://input"), $post_content);
			var_dump($put_content);
		}

		die('GameController/delete');
	}

	public function updateAction()
	{
		if($_SERVER['REQUEST_METHOD'] == 'PUT')
		{
			parse_str(file_get_contents("php://input"), $post_content);
			var_dump($put_content);
		}

		die('GameController/udpate');
	}


}