<?php

require_once __DIR__.'/AppController.php';

class ProductController extends AppController {

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
        'messages' => [
          'name' => empty($createItemRequest['name']) ? 'Can\'t be empty' : null,
          'description' => empty($createItemRequest['description']) ? 'Can\'t be empty' : null,
          'unit' => empty($createItemRequest['unit']) ? 'Can\'t be empty' : null,
          'image' => empty($createItemRequest['image']) ? 'Can\'t be empty' : null,
        ],
      ];
    }


    var_dump(pathinfo($createItemRequest['image']));
    if(!is_file($createItemRequest['image'])) {
      return [
        'isValid' => false,
        'messages' => [
          'name' => null,
          'description' => null,
          'unit' => null,
          'image' => "Must be a valid image"
        ],
      ];
    }

    return [
      'isValid' => false,
      'messages' => [
        'name' => ":(",
        'image' => "",
        'description' => ":(",
        'unit' => ":(",
      ]
    ];
  }


  public function product(string $id = null) {
    $createItemRequest = $this->parseCreateItemRequest($_POST, $_FILES);

    if (is_null($createItemRequest)) {
      return $this->renderProtected('product');
    } else {
      $validationResult = $this->validateCreateItemRequest($createItemRequest);

      header('Content-Type: application/json; charset=utf-8');
      echo json_encode($validationResult);
    };

    //      if ($validationResult["isValid"]) {
//        $this->services->getAuthService()->logIn($loginRequest["email"]);
//        $this->services->getRoutingService()->redirectToHome();
//      } else {
//        $this->renderUnprotected('auth', [
//          'type' => 'login',
//          'messages' => $validationResult['messages']
//        ]);
//      }
    //   };
  }
}