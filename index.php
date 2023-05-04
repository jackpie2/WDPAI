<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::set('login', 'DefaultController');
Router::set('main', 'DefaultController');
Router::set('product', 'DefaultController');
Router::set('profile', 'DefaultController');
Router::set('', 'DefaultController');
Router::run($path);
