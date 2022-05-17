<?php

require_once __DIR__.'/AppController.php';

class AuthController extends AppController {
  public function auth() {
    return $this->render('auth');
  }
}
