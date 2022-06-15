<?php

require_once __DIR__.'/AppController.php';
require_once __DIR__.'/../repository/UserRepository.php';

require_once __DIR__.'/../vendor/firebase/php-jwt/src/JWT.php';
require_once __DIR__.'/../vendor/firebase/php-jwt/src/KEY.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController extends AppController {
    private UserRepository $userRepository;

    public function __construct($services) {
      parent::__construct($services);

      $this->userRepository = new UserRepository();
    }

  private function parseLoginRequest($userInput): ?array {
    if (!isset($userInput['email']) && !isset($userInput['password'])) {
      return null;
    }

    return [
      "email" => $userInput['email'] ?? null,
      "password" => $userInput['password'] ?? null,
    ];
  }

  private function parseRegisterRequest($userInput): ?array {
    if (!isset($userInput['email']) && !isset($userInput['password']) && !isset($userInput["repeated_password"])) {
      return null;
    }

    return [
      "email" => $userInput['email'] ?? null,
      "password" => $userInput['password'] ?? null,
      "repeated_password" => $userInput['repeated_password'] ?? null,
    ];
  }

  private function validateLoginRequest($loginRequest): array {
    if (empty($loginRequest['email']) || empty($loginRequest['password'])) {
      return  [
        'isValid' => false,
        'messages' => [
          'email' => empty($loginRequest['email']) ? 'Can\'t be empty' : null,
          'password' => empty($loginRequest['password']) ? 'Can\'t be empty' : null,
        ],
      ];
    }

    $user = $this->userRepository->getUser($loginRequest['email']);

    if (!$user) {
      return  [
        'isValid' => false,
        'messages' => ['email' => 'User does not exist', 'password' => null],
      ];
    }

    if (!$user->checkPassword($loginRequest["password"])) {
      return [
        'isValid' => false,
        'messages' => ['email' => null, 'password' => 'Incorrect password']
      ];
    }

    return [
      'isValid' => true,
      'messages' => ['email' => null, 'password' => null]
    ];
  }

  private function validateRegisterRequest($registerRequest): array {
    if (empty($loginRequest['email']) || empty($loginRequest['password']) || empty($loginRequest['repeated_password'])) {
      return  [
        'isValid' => false,
        'messages' => [
          'email' => empty($loginRequest['email']) ? 'Can\'t be empty' : null,
          'password' => empty($loginRequest['password']) ? 'Can\'t be empty' : null,
          'repeated_password' => empty($loginRequest['repeated_password']) ? 'Can\'t be empty' : null,
        ],
      ];
    }

    $existingUser = $this->userRepository->getUser($registerRequest['email']);

    if ($existingUser) {
      return  [
        'isValid' => false,
        'messages' => ['email' => 'Email already taken', 'password' => null, 'repeated_password' => null],
      ];
    }

    if (!$this->services->getValidationService()->isEmail($registerRequest["email"])) {
      return [
        'isValid' => false,
        'messages' => ['email' => "Email is not valid", 'password' => null, 'repeated_password' => null],
      ];
    }

    if ($registerRequest['password'] !== $registerRequest["repeated_password"]) {
      return [
        'isValid' => false,
        'messages' => ['email' => null, 'password' => null, 'repeated_password' => 'Passwords do not match'],
      ];
    }

    return [
      'isValid' => true,
      'messages' => ['email' => null, 'password' => null, 'repeated_password' => null],
    ];
  }

  public function login() {
    $loginRequest = $this->parseLoginRequest($_POST);

    if (is_null($loginRequest) || $this->services->getAuthService()->isLoggedIn()) {
      $this->renderUnprotected('auth', ['type' => 'login']);
    } else {
      $validationResult = $this->validateLoginRequest($loginRequest);

      if ($validationResult["isValid"]) {
        $this->services->getAuthService()->logIn($loginRequest["email"]);
        $this->services->getRoutingService()->redirectToHome();
      } else {
        $this->renderUnprotected('auth', [
          'type' => 'login',
          'messages' => $validationResult['messages']
        ]);
      }
    }
  }

  public function logout() {
    $this->services->getAuthService()->logOut();
    $this->renderUnprotected('auth', ['type' => 'login']);
  }

  public function register() {
    $registerRequest = $this->parseRegisterRequest($_POST);

    if (is_null($registerRequest) || $this->services->getAuthService()->isLoggedIn()) {
      $this->renderUnprotected('auth', ['type' => 'register']);
    } else {
      $validationResult = $this->validateRegisterRequest($registerRequest);

      if ($validationResult['isValid']) {
        $newUser = new User($registerRequest["email"], password_hash($registerRequest["password"],  PASSWORD_BCRYPT ));
        $this->userRepository->addUser($newUser);

        $this->services->getAuthService()->logIn($registerRequest["email"]);
        $this->services->getRoutingService()->redirectToHome();
      } else {
        $this->renderUnprotected('auth', [
          'type' => 'register',
          'messages' => $validationResult['messages']
        ]);
      }
    }
  }
}
