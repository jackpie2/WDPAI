<?php

include_once 'src/controllers/DefaultController.php';
include_once 'src/controllers/SecurityController.php';

class Router
{
    public static $routes;

    public static function get($url, $controller)
    {
        self::$routes[$url] = $controller;
    }

    public static function post($url, $controller)
    {
        self::$routes[$url] = $controller;
    }

    public static function run($url)
    {
        $action = explode('/', $url)[0];

        if (!array_key_exists($action, self::$routes)) {
            die("Wrong URL");
        }

        $controller = self::$routes[$action];
        $object = new $controller;
        $action = $action ?: 'main';

        $object->$action();
    }
}
