<?php

class ValidationService{

  public function isEmail(string $str): bool {
    return !!filter_var($str, FILTER_VALIDATE_EMAIL);
  }
}