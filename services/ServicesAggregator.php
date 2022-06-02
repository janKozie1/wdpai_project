<?php

class ServicesAggregator {
  private AuthService $authService;
  private RoutingService $routingService;
  private ValidationService  $validationService;

  public function __construct(AuthService $authService, RoutingService $routingService, ValidationService $validationService) {
    $this->authService = $authService;
    $this->routingService = $routingService;
    $this->validationService = $validationService;
  }

  public function getAuthService(): AuthService {
    return $this->authService;
  }

  public function getRoutingService(): RoutingService {
    return $this->routingService;
  }

  public function getValidationService(): ValidationService {
    return $this->validationService;
  }
}