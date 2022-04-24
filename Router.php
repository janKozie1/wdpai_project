<?php

require_once __DIR__.'/controllers/DashboardController.php';
require_once __DIR__.'/controllers/ProjectsController.php';

class Router {

  public static $routes;

  public static function get($url, $view) {
    self::$routes[$url] = $view;
  }

  public static function run ($url) {
    $urlParts = explode("/", $url);
    $action = $urlParts[0];

    if (!array_key_exists($action, self::$routes)) {
      die("Wrong url!");
    }

    $controller = self::$routes[$action];
    $object = new $controller;
    $action = $action ?: 'index';

    $id = $urlParts[1] ?? null;

    $object->$action($id);
  }
}
