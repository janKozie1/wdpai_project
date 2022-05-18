<?php

class PantryController extends AppController {
  public function pantry() {
    return $this->renderProtected('pantry');
  }
}