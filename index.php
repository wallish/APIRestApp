<?php

require_once 'autoload.php';

define('DB_SUCCESS', 1);
define('DB_SUCCESS_ADD', 2);
define('DB_SUCCESS_UPDATE', 3);
define('DB_SUCCESS_DELETE', 4);

/*define("DATABASE_HOST", 'localhost');
define("DATABASE_DB", 'jeuxvideos');
define("DATABASE_USER", 'root');
define("DATABASE_PASSWORD", '');
*/

// beta config loader
/*defined('APPLICATION_PATH') or define('APPLICATION_PATH', dirname(__FILE__));
$const = 'APPLICATION_ENV';
$defaultEnvironment = 'development';
defined($const) || define($const, (getenv($const) ? getenv($const) : $defaultEnvironmentu));
die($const);
*/
$config = parse_ini_file('config/app.ini');
$GLOBALS['config'] = $config;
// put in gloabls
//die(var_dump((object)$parsed));
//Security::verify();
Routing::parseURI();
