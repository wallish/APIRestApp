<?php

require_once 'routing.php';
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

Routing::parseURI();