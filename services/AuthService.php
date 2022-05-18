<?php

class AuthService {
  private string $jwtKey;

  public function __construct(string $jwtKey) {
    $this->jwtKey = $jwtKey;
  }

  public function isLoggedIn(): bool {
    return false;
  }

  public function logIn($email): void {
    return;
  }

  public function logOut(): void {

  }
}