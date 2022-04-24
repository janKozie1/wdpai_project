<?php

require_once __DIR__.'/AppController.php';

class DashboardController extends AppController {
  public function dashboard() {
    return $this->render('dashboard', ['greetings' => 'Jan :D']);
  }
}
