<?php

require_once 'core/Controller.php';
require_once 'core/Routing.php';
require_once 'core/Database.php';
require_once 'core/Model.php';
require_once 'core/Security.php';
require_once 'models/Game.php';

require_once 'controllers/ConsoleController.php';
require_once 'controllers/IndexController.php';

/*
function __autoload($className) {
	echo $className;
      if (file_exists($className . '.php') || file_exists('controllers/'.$className . '.php')) {
          require_once $className . '.php';
          
      }      
} */
#@TODO : autoloader

//Security::verify();
Routing::parseURI();