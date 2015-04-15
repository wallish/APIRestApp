<?php


class Routing {

	public static function parseURI()
	{
		$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";		
		$uri = parse_url($actual_link);

		$path = explode('/', substr($uri['path'],1));

		$folder = array_shift($path);
		$controller = array_shift($path).'Controller';
		$action = array_shift($path).'Action';
		$args = $path;

		if($controller == "Controller" && $action == "Action"){
			$controller = new IndexController();
			$controller->indexAction($args);
		}else{
			$controller = new $controller();
			$controller->$action($args);
	
		}
		
	}

}