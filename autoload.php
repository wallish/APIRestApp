<?php

function __autoload($className)
{
    if (file_exists($className.'.php')) {
        require_once $className.'.php';
    } elseif (file_exists('controllers/'.$className.'.php')) {
        require_once 'controllers/'.$className.'.php';
    } elseif (file_exists('core/'.$className.'.php')) {
        require_once 'core/'.$className.'.php';
    } elseif (file_exists('models/'.$className.'.php')) {
        require_once 'models/'.$className.'.php';
    } elseif (file_exists('lib/'.$className.'.php')) {
        require_once 'lib/'.$className.'.php';
    }
}
