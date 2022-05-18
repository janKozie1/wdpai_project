<?php

class RoutingService {
  private string $homePath;
  private string $loginPath;

  public function __construct(string $homePath, string $loginPath) {
    $this->homePath = $homePath;
    $this->loginPath = $loginPath;
  }

  private function getHTTPPrefix(): string {
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
      return "https://";
    return "http://";
  }

  private function getServerURL(): string {
    return "{$this->getHTTPPrefix()}{$_SERVER['HTTP_HOST']}";
  }

  public function redirect(string $path): void {
    header("Location: {$this->getServerURL()}$path");
  }

  public function redirectToHome(): void {
    $this->redirect($this->homePath);
  }

  public function redirectToLogin(): void {
    $this->redirect($this->loginPath);
  }
}