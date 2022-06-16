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

  public function getMeasurementUnit(string $id): ?MeasurementUnit {
    $stmt = $this->database->connect()->prepare('
        SELECT measurment_unit_id, measurment_unit_name FROM public.measurment_units where measurment_unit_id = :id
    ');
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();

    $measurementUnit = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$measurementUnit) {
      return null;
    }

    return new MeasurementUnit(
      $measurementUnit['measurment_unit_id'],
      $measurementUnit['measurment_unit_name'],
    );
  }
}
