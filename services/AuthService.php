<?php

require_once __DIR__.'/../vendor/firebase/php-jwt/src/JWT.php';
require_once __DIR__.'/../vendor/firebase/php-jwt/src/KEY.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthService {
  private string $jwtKey;

  private static string $jwtAlg = 'HS256';
  private static string $loginCookieName = 'loggedInUser';
  private static int $loginCookieExpiryTime = 60 * 60 * 24;

  public function __construct(string $jwtKey) {
    $this->jwtKey = $jwtKey;
  }

  public function isLoggedIn(): bool {
    if (!isset($_COOKIE[AuthService::$loginCookieName])) {
      return false;
    }

    try {
      $cookieValue = (array) JWT::decode(
        $_COOKIE[AuthService::$loginCookieName],
        new Key($this->jwtKey, AuthService::$jwtAlg)
      );

      return isset($cookieValue["email"]) && !empty($cookieValue["email"]);
    } catch (Exception $e) {
      return false;
    }
  }

  public function logIn($email): void {
    $now = time();

    $cookie_value = JWT::encode([
      "email" => $email,
      "iat" => $now,
    ], $this->jwtKey, AuthService::$jwtAlg);

    setcookie(AuthService::$loginCookieName, $cookie_value, $now + AuthService::$loginCookieExpiryTime);
  }

  public function logOut(): void {
    setcookie(AuthService::$loginCookieName, "", time() - AuthService::$loginCookieExpiryTime);
  }
}