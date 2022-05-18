<?php

class ProductController extends AppController {
  public function pantry() {
    return $this->renderProtected('product');
  }
}