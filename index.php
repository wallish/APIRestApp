<?php

require_once 'autoload.php';

define("DB_SUCCESS", 1);
define("DB_SUCCESS_ADD", 2);
define("DB_SUCCESS_UPDATE", 3);
define("DB_SUCCESS_DELETE", 4);

define("DATABASE_HOST", 'localhost');
define("DATABASE_DB", 'jeuxvideos');
define("DATABASE_USER", 'root');
define("DATABASE_PASSWORD", '');
//Security::verify();
Routing::parseURI();
