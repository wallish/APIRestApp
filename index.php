<?php

require_once 'autoload.php';

define('DB_SUCCESS', 1);
define('DB_SUCCESS_ADD', 2);
define('DB_SUCCESS_UPDATE', 3);
define('DB_SUCCESS_DELETE', 4);

// beta config loader
/*defined('APPLICATION_PATH') or define('APPLICATION_PATH', dirname(__FILE__));
$const = 'APPLICATION_ENV';
$defaultEnvironment = 'development';
defined($const) || define($const, (getenv($const) ? getenv($const) : $defaultEnvironmentu));
die($const);
*/
if (!file_exists('config/app.ini'))
{
	die('<b>app.ini missing</b> : You need to create an app.ini file in the folder /config, for that use app.ini.example');
}
$config = parse_ini_file('config/app.ini');
$GLOBALS['config'] = $config;
// put in gloabls
//die(var_dump((object)$parsed));
//Security::verify();
Routing::parseURI();
