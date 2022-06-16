<?php

class ServicesAggregator {
  private AuthService $authService;
  private RoutingService $routingService;
  private ValidationService  $validationService;
  private FileService $fileService;

  public function __construct(
    AuthService $authService,
    RoutingService $routingService,
    ValidationService $validationService,
    FileService $fileService
  ) {
    $this->authService = $authService;
    $this->routingService = $routingService;
    $this->validationService = $validationService;
    $this->fileService = $fileService;
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

  public function getFileService(): FileService{
    return $this->fileService;
  }
}