<?php

class AppController {
  public function render(string $filename = 'index', array $variables = []) {
    $filepath = 'public/views/'.$filename.'.html';
    $output = "Page not found";

    if (file_exists($filepath)) {
      extract($variables);

      ob_start();
      include $filepath;
      $output = ob_get_clean();
    }

    print $output;
  }
}
