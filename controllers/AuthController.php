<?php

require_once __DIR__.'/AppController.php';

require_once __DIR__.'/../vendor/firebase/php-jwt/src/JWT.php';
require_once __DIR__.'/../vendor/firebase/php-jwt/src/KEY.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController extends AppController {
  private function parseLoginRequest($userInput): ?array {
    if (!isset($userInput['email']) && !isset($userInput['password'])) {
      return null;
    }

    return [
      "email" => $userInput['email'] ?? null,
      "password" => $userInput['password'] ?? null,
    ];
  }

  private function parseSignupRequest($userInput): ?array {
    if (!isset($userInput['email']) && !isset($userInput['password']) && !isset($userInput["repeated_password"])) {
      return null;
    }

    return [
      "email" => $userInput['email'] ?? null,
      "password" => $userInput['password'] ?? null,
      "repeated_password" => $userInput['repeated_password'] ?? null,
    ];
  }

  private function validateLoginRequest($loginRequest): array {
    return [
      'isValid' => $loginRequest["password"] === "1234",
      'messages' => ['email' => 'User does not exist', 'password' => 'Incorrect password']
    ];
  }

  public function login() {
    $loginRequest = $this->parseLoginRequest($_POST);

    if (is_null($loginRequest) || $this->services->getAuthService()->isLoggedIn()) {
      $this->renderUnprotected('auth', ['type' => 'login']);
    } else {
      $validationResult = $this->validateLoginRequest($loginRequest);

      if ($validationResult["isValid"]) {
        $this->services->getAuthService()->logIn($loginRequest["email"]);
        $this->services->getRoutingService()->redirectToHome();
      } else {
        $this->renderUnprotected('auth', [
          'type' => 'login',
          'messages' => $validationResult['messages']
        ]);
      }
    }
  }

  public function logout() {
    $this->services->getAuthService()->logOut();
    $this->renderUnprotected('auth', ['type' => 'login']);
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

    $this->renderUnprotected('auth', ['type' => 'register']);
  }
}
