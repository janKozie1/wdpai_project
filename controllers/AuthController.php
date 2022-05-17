<?php

require_once __DIR__.'/AppController.php';

class AuthController extends AppController {
  public function login() {
    return $this->render('auth', ['type' => 'login']);
  }

  public function register() {
    return $this->render('auth', ['type' => 'register']);
  }
}
