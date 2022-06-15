<?php

require_once __DIR__.'/AppController.php';
require_once __DIR__.'/../repository/MeasurementUnitsRepository.php';

class PantryController extends AppController {
  private MeasurementUnitsRepository $measurementUnitsRepository;

  public function __construct($services) {
    parent::__construct($services);

    $this->measurementUnitsRepository = new MeasurementUnitsRepository();
  }

  public function pantry() {
    return $this->renderProtected('pantry', [
      "units" => $this->measurementUnitsRepository->getMeasurementUnits()
    ]);
  }
}