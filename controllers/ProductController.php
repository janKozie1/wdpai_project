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

  private function parseCreateItemRequest($userInput, $userFiles): ?array {
    $someFieldsArePresent = isset($userInput['name'])
      || isset($userFiles['image'])
      || isset($userInput['description'])
      || isset($userInput['unit']);

    if (!$someFieldsArePresent) {
      return null;
    }

    return [
      "name" => $userInput['name'] ?? null,
      "image" => $userFiles['image'] ?? null,
      "description" => $userInput['description'] ?? null,
      "unit" => $userInput['unit'] ?? null,
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


  public function product(string $id = null) {
    $createItemRequest = $this->parseCreateItemRequest($_POST, $_FILES);

    if (is_null($createItemRequest) || !$this->services->getAuthService()->isLoggedIn()) {
      return $this->renderProtected('product');
    } else {
      $validationResult = $this->validateCreateItemRequest($createItemRequest);

      if ($validationResult["isValid"]) {
        $newFileName = $this->services->getFileService()->saveUploadedFile($validationResult['validData']['image']);
        $validationResult['validData']['image'] = $newFileName;


        $user = $this->userRepository->getUser($this->services->getAuthService()->getLoggedInEmail());
        $this->productRepository->createNewProduct($user, new Product(
          $validationResult['validData']['name'],
          $validationResult['validData']['description'],
          $validationResult['validData']['image'],
          $this->measurementUnitsRepository->getMeasurementUnit($validationResult['validData']['unit'])
        ));
      }

      header('Content-Type: application/json; charset=utf-8');
      echo json_encode($validationResult);
    };
  }
}