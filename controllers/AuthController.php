<?php

require_once __DIR__.'/AppController.php';

require_once __DIR__.'/../vendor/firebase/php-jwt/src/JWT.php';
require_once __DIR__.'/../vendor/firebase/php-jwt/src/KEY.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController extends AppController {
  public function login() {
    return $this->renderUnprotected('auth', ['type' => 'login']);
  }

  public function register() {
    $key = 'example_key';
    $payload = [
      'iss' => 'http://example.org',
      'aud' => 'http://example.com',
      'iat' => 1356999524,
      'nbf' => 1357000000
    ];


    $jwt = JWT::encode($payload, $key, 'HS256');
    $decoded = JWT::decode($jwt, new Key($key, 'HS256'));

    return $this->renderUnprotected('auth', ['type' => 'register']);
  }
}
