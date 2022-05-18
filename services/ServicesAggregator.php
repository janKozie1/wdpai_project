<?php

class ServicesAggregator {
  private AuthService $authService;
  private RoutingService $routingService;

  public function __construct(AuthService $authService, RoutingService $routingService) {
    $this->authService = $authService;
    $this->routingService = $routingService;
  }

  public function getAuthService(): AuthService {
    return $this->authService;
  }

  public function getRoutingService(): RoutingService {
    return $this->routingService;
  }
}