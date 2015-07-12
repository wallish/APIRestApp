<?php

class Routing
{
    public static function parseURI()
    {
        $path = explode('/', substr($_SERVER['REQUEST_URI'], 1));
        //$folder = array_shift($path);
        $controller = array_shift($path).'Controller';
        $action = array_shift($path).'Action';
        $args = $path;

        if ($controller == 'Controller' && $action == 'Action') {
            $controller = new IndexController();
            $controller->indexAction($args);
        } else {
            if (class_exists($controller)) {
                $controller = new $controller();
                $controller->$action($args);
            } else {
                die('controller not found');
            }
        }
    }
}
