<?php

require 'Router.php';

require_once __DIR__.'/services/ServicesAggregator.php';
require_once __DIR__.'/services/AuthService.php';
require_once __DIR__.'/services/RoutingService.php';

$services = new ServicesAggregator(
  new AuthService("JWT KEY"),
  new RoutingService("/pantry", "/login")
);

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('', 'HomeController');
Router::get('pantry', 'PantryController');
Router::get('product', 'ProductController');
Router::get('register', 'AuthController');
Router::get('login', 'AuthController');

Router::run($path, $services);
?>
