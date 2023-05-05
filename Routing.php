<?php

include_once 'src/controllers/DefaultController.php';

class Router
{
    public static $routes;

    public static function get($url, $controller)
    {
        self::$routes[$url] = $controller;
    }

    public static function run($url)
    {
        $action = explode('/', $url)[0];

        if ($action == "") {
            $action = "main";
        }

        if (!array_key_exists($action, self::$routes)) {
            die("Wrong URL");
        }

        $controller = self::$routes[$action];
        $object = new $controller;
        $object->$action();
    }
}
