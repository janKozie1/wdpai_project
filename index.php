<?php

require 'Router.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('', 'DashboardController');
Router::get('dashboard', 'DashboardController');
Router::get('projects', 'ProjectsController');
Router::get('auth', 'AuthController');

Router::run($path);
?>
