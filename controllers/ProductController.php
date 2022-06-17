<?php

require_once __DIR__.'/AppController.php';
require_once __DIR__.'/../repository/MeasurementUnitsRepository.php';
require_once __DIR__.'/../repository/ProductRepository.php';
require_once __DIR__.'/../models/Product.php';

class ProductController extends AppController {
  private MeasurementUnitsRepository $measurementUnitsRepository;
  private ProductRepository $productRepository;
  private UserRepository $userRepository;

  public function __construct($services) {
    parent::__construct($services);

    $this->measurementUnitsRepository = new MeasurementUnitsRepository();
    $this->productRepository = new ProductRepository();
    $this->userRepository = new UserRepository();
  }

  private function parseRequest($userInput, $userFiles): array {
    return [
      "name" => empty($userInput['name']) ? null : $userInput['name'],
      "image" => empty($userFiles['image']) || $userFiles['image']['size'] === 0 ? null : $userFiles['image'],
      "description" => empty($userInput['description']) ? null : $userInput['description'],
      "unit" => empty($userInput['unit']) ? null : $userInput['unit'],
    ];
  }

  private function validateCreateItemRequest($createItemRequest): array {
    if (empty($createItemRequest['name'])
      || empty($createItemRequest['description'])
      || empty($createItemRequest['unit'])
      || empty($createItemRequest['image'])
    ) {
      return  [
        'isValid' => false,
        'validData' => null,
        'messages' => [
          'name' => empty($createItemRequest['name']) ? 'Can\'t be empty' : null,
          'description' => empty($createItemRequest['description']) ? 'Can\'t be empty' : null,
          'unit' => empty($createItemRequest['unit']) ? 'Can\'t be empty' : null,
          'image' => empty($createItemRequest['image']) ? 'Can\'t be empty' : null,
        ],
      ];
    }

    if(!is_array($createItemRequest['image']) || !str_contains($createItemRequest['image']['type'], "image")) {
      return [
        'isValid' => false,
        'validData' => null,
        'messages' => [
          'name' => null,
          'description' => null,
          'unit' => null,
          'image' => "Must be a valid image"
        ],
      ];
    }

    return [
      'isValid' => true,
      'validData' => $createItemRequest,
      'messages' => []
    ];
  }

  private function validateEditItemRequest($editItemRequest): array {
    if(is_array($editItemRequest['image']) && !str_contains($editItemRequest['image']['type'], "image")) {
      return [
        'isValid' => false,
        'validData' => null,
        'messages' => [
          'name' => null,
          'description' => null,
          'unit' => null,
          'image' => "Must be a valid image"
        ],
      ];
    }

    return [
      'isValid' => true,
      'validData' => $editItemRequest,
      'messages' => []
    ];
  }

  private function handleItemRequest(?User $user, array $validationResult, ?string $id, bool $editing) {
    if ($validationResult["isValid"]) {
      if ($validationResult['validData']['image']){
        $newFileName = $this->services->getFileService()->saveUploadedFile($validationResult['validData']['image']);
        $validationResult['validData']['image'] = $newFileName;
      }

      $product = $id ? $this->productRepository->getProduct($user, $id) : new Product(
        $validationResult['validData']['name'],
        $validationResult['validData']['description'],
        $validationResult['validData']['image'],
        $this->measurementUnitsRepository->getMeasurementUnit($validationResult['validData']['unit']),
      );

      if ($editing) {
        $validationResult['validData']['name'] && $product->setName($validationResult['validData']['name']);
        $validationResult['validData']['description'] && $product->setDescription($validationResult['validData']['description']);
        $validationResult['validData']['image'] && $product->setImage($validationResult['validData']['image']);
        $validationResult['validData']['unit'] && $product->setMeasurementUnit($this->measurementUnitsRepository->getMeasurementUnit($validationResult['validData']['unit']));

        $this->productRepository->updateProduct($user, $product);
      } else {
        $this->productRepository->createNewProduct($user, $product);
      }
    }

    $this->sendProtectedJson($validationResult);
  }


  public function product(?string $id = null) {
    $user = $this->userRepository->getUser($this->services->getAuthService()->getLoggedInEmail());
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'GET') {
      $this->renderProtected('product', [
        'product' => $this->productRepository->getProduct($user, $id),
        'units' => $this->measurementUnitsRepository->getMeasurementUnits(),
      ]);
    } else if ($method === 'POST' && !$id) {
      $this->handleItemRequest($user, $this->validateCreateItemRequest($this->parseRequest($_POST, $_FILES)), $id, false);
    } else if ($method === 'POST' && $id) {
      $this->handleItemRequest($user, $this->validateEditItemRequest($this->parseRequest($_POST, $_FILES)), $id, true);
    } else if ($method === 'DELETE') {
      $didDelete = $this->productRepository->deleteProduct($user, $id);
      $this->sendProtectedJson(["ok" => $didDelete]);
    }  else {
      $this->sendProtectedJson(["ok" => false]);
    }
  }
}