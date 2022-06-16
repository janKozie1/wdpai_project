<?php

class Product {
  private string $name;
  private string $description;
  private string $image;
  private MeasurementUnit $measurementUnit;
  private ?string $id;

  public function __construct(string $name, string $description, string $image, MeasurementUnit $measurementUnit, ?string $id = null) {
    $this->name = $name;
    $this->description = $description;
    $this->image = $image;
    $this->measurementUnit = $measurementUnit;
    $this->id = $id;
  }

  public function getName(): string {
    return $this->name;
  }

  public function setName(string $name): void {
    $this->name = $name;
  }

  public function getDescription(): string {
    return $this->description;
  }

  public function setDescription(string $description): void {
    $this->description = $description;
  }

  public function getImage(): string {
    return $this->image;
  }

  public function setImage(string $image): void {
    $this->image = $image;
  }

  public function getMeasurementUnit(): MeasurementUnit {
    return $this->measurementUnit;
  }

  public function setMeasurementUnit(MeasurementUnit $measurementUnit): void {
    $this->measurementUnit = $measurementUnit;
  }

  public function getId(): string {
    return $this->id;
  }
}