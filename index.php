<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('login', 'DefaultController');
Router::get('product', 'DefaultController');
Router::get('profile', 'DefaultController');
Router::get('saved', 'DefaultController');
Router::get('', 'DefaultController');

Router::post('user_login', 'SecurityController');
Router::post('user_logout', 'SecurityController');

Router::run($path);
