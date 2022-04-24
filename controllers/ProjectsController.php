<?php

require_once __DIR__.'/AppController.php';

class ProjectsController extends AppController {
  public function projects(string $id = null) {
    return $this->render('index', ['id' => $id]);
  }
}
