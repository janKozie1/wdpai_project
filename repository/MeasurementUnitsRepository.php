<?php

require_once __DIR__.'/Repository.php';
require_once __DIR__.'/../models/MeasurementUnit.php';


class MeasurementUnitsRepository extends Repository {
  public function getMeasurementUnits(): array {
    $stmt = $this->database->connect()->prepare('
        SELECT measurment_unit_id, measurment_unit_name FROM public.measurment_units
    ');
    $stmt->execute();

    $measurementUnits = [];

    while ($measurementUnit = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $measurementUnits[] = new MeasurementUnit(
        $measurementUnit['measurment_unit_id'],
        $measurementUnit['measurment_unit_name'],
      );
    };

    return $measurementUnits;
  }
}
