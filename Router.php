<?php

require_once __DIR__.'/controllers/HomeController.php';
require_once __DIR__.'/controllers/PantryController.php';
require_once __DIR__.'/controllers/AuthController.php';
require_once __DIR__.'/controllers/ProductController.php';

class Router {

  public static array $routes;

  public static function get($url, $view) {
    self::$routes[$url] = $view;
  }

  public static function run (string $url, ServicesAggregator $services) {
    $urlParts = explode("/", $url);
    $action = $urlParts[0];

    if (!array_key_exists($action, self::$routes)) {
      $services->getRoutingService()->redirectToHome();
    } else {
      $controller = self::$routes[$action];
      $object = new $controller($services);
      $action = $action ?: 'index';

      $id = $urlParts[1] ?? null;

      $object->$action($id);
    }
  }
}
