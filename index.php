<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('register', 'DefaultController');
Router::get('login', 'DefaultController');
Router::get('product', 'DefaultController');
Router::get('profile', 'DefaultController');
Router::get('saved', 'DefaultController');
Router::get('add_product', 'DefaultController');
Router::get('', 'DefaultController');

Router::post('user_login', 'SecurityController');
Router::post('user_logout', 'SecurityController');
Router::post('user_register', 'SecurityController');
Router::post('rate', 'DefaultController');
Router::post('addProduct', 'CoffeeController');
Router::post('search', 'CoffeeController');
Router::post('rateProduct', 'CoffeeController');

Router::run($path);
