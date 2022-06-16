<?php

require 'Router.php';

require_once __DIR__.'/services/ServicesAggregator.php';
require_once __DIR__.'/services/AuthService.php';
require_once __DIR__.'/services/RoutingService.php';
require_once __DIR__.'/services/ValidationService.php';
require_once __DIR__.'/services/FileService.php';

$services = new ServicesAggregator(
  new AuthService("JWT KEY"),
  new RoutingService("/pantry", "/login"),
  new ValidationService(),
  new FileService('/public/images/uploads/'),
);

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('', 'HomeController');
Router::get('pantry', 'PantryController');
Router::get('product', 'ProductController');
Router::get('register', 'AuthController');
Router::get('logout', 'AuthController');
Router::get('login', 'AuthController');

Router::run($path, $services);
?>
