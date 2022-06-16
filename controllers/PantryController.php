<?php

require_once __DIR__.'/AppController.php';
require_once __DIR__.'/../repository/MeasurementUnitsRepository.php';
require_once __DIR__.'/../repository/ProductRepository.php';

class PantryController extends AppController {
  private MeasurementUnitsRepository $measurementUnitsRepository;
  private ProductRepository $productRepository;
  private UserRepository $userRepository;

  public function __construct($services) {
    parent::__construct($services);

    $this->measurementUnitsRepository = new MeasurementUnitsRepository();
    $this->productRepository = new ProductRepository();
    $this->userRepository = new UserRepository();
  }

  public function pantry() {
    return $this->renderProtected('pantry', [
      "units" => $this->measurementUnitsRepository->getMeasurementUnits(),
      "products" => $this->productRepository->getAllProducts(
         $this->userRepository->getUser($this->services->getAuthService()->getLoggedInEmail()),
        $_GET["search"] ?? null
      )
    ]);
  }
}