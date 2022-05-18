<?php

class AppController {
  protected ServicesAggregator $services;

  public function __construct($services){
    $this->services = $services;
  }

  private function getViewFilePath(string $view): string {
    return "public/views/{$view}.php";
  }

  private function getView(string $filepath, array $variables): string {
    extract($variables);

    ob_start();
    include $filepath;
    return ob_get_clean();
  }

  private function render(string $view, array $variables = []): void {
    $path = $this->getViewFilePath($view);

    print (file_exists($path)
      ? $this->getView($path, $variables)
      : $this->getView($this->getViewFilePath('404'), $variables));
  }

  public function renderProtected(string $filename, array $variables = []): void {
    if ($this->services->getAuthService()->isLoggedIn()) {
      $this->render($filename, $variables);
    } else {
      $this->services->getRoutingService()->redirectToLogin();
    }
  }

  public function renderUnprotected(string $filename, array $variables = []): void {
    if (!$this->services->getAuthService()->isLoggedIn() && 0 == 1) {
      $this->render($filename, $variables);
    } else {
      $this->services->getRoutingService()->redirectToHome();
    }
  }

  public function renderPublic(string $filename, array $variables = []): void {
    $this->render($filename, $variables);
  }
}
