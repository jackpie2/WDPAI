<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('register', 'DefaultController');
Router::get('login', 'DefaultController');
Router::get('product', 'DefaultController');
Router::get('profile', 'DefaultController');
Router::get('saved', 'DefaultController');
Router::get('addProduct', 'DefaultController');
Router::get('', 'DefaultController');

Router::post('userLogin', 'SecurityController');
Router::post('userLogout', 'SecurityController');
Router::post('userRegister', 'SecurityController');
Router::post('rate', 'DefaultController');
Router::post('addProduct', 'CoffeeController');
Router::post('search', 'CoffeeController');
Router::post('rateProduct', 'CoffeeController');
Router::post('bookmarkProduct', 'CoffeeController');

Router::run($path);