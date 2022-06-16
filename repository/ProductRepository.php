<?php

require_once __DIR__.'/Repository.php';
require_once __DIR__.'/MeasurementUnitsRepository.php';
require_once __DIR__.'/../models/Product.php';

class ProductRepository extends Repository {
  private MeasurementUnitsRepository $measurementUnitRepository;

  public function __construct() {
    parent::__construct();

    $this->measurementUnitRepository = new MeasurementUnitsRepository();
  }

  public function createNewProduct(?User $user, Product $product) {
    if (!$user) {
      return;
    }

    $PDO = $this->database->connect();

    $PDO->beginTransaction();
    $createDetailsStmt = $PDO->prepare('
        INSERT INTO products_details(product_name, product_description, product_image_url, measurment_unit_id) VALUES (?, ?, ?, ?) RETURNING product_detail_id;
    ');
    $createDetailsStmt->execute([
      $product->getName(),
      $product->getDescription(),
      $product->getImage(),
      $product->getMeasurementUnit()->getId(),
    ]);

    $details = $createDetailsStmt->fetch(PDO::FETCH_ASSOC);

    if (!$details) {
      $PDO->rollBack();
      return;
    }

    $detailsId = $details['product_detail_id'];
    $userEmail = $user->getEmail();

    $createProductStmt = $PDO->prepare('
       INSERT into products (user_id, product_detail_id) SELECT users.user_id, :detailsId from users where users.user_email=:userEmail;
    ');

    $createProductStmt->bindParam(':detailsId', $detailsId, PDO::PARAM_STR);
    $createProductStmt->bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
    $createProductStmt->execute();

    $PDO->commit();
  }

  public function getAllProducts(?User $user, ?string $search = ""): array {
    if (!$user) {
      return [];
    }

    $userId = $user->getId();
    $search = empty($search) ? null : $search;

    $stmt = $this->database->connect()->prepare('
        SELECT 
            P.product_id, PD.product_name, PD.product_description, PD.product_image_url, PD.measurment_unit_id
        FROM 
            products as P 
        INNER JOIN 
            products_details as PD 
        ON 
            PD.product_detail_id = P.product_detail_id 
        where 
            P.user_id = :userId AND (PD.product_name ILIKE :search OR :search is NULL)
    ');

    //CONCAT(\'%\', :search, \'%\')
    $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
    $stmt->bindParam(':search', $search, PDO::PARAM_STR);
    $stmt->execute();

    $products = [];

    while ($product = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $products[] = new Product(
        $product['product_name'],
        $product['product_description'],
        $product['product_image_url'],
        $this->measurementUnitRepository->getMeasurementUnit($product['measurment_unit_id']),
        $product['product_id'],
      );
    };

    return $products;
  }

  public function getProduct(?User $user, ?string $id): ?Product {
    if (!$user || !$id) {
      return null;
    }

    $userId = $user->getId();

    $stmt = $this->database->connect()->prepare('
        SELECT 
            P.product_id, PD.product_name, PD.product_description, PD.product_image_url, PD.measurment_unit_id
        FROM 
            products as P 
        INNER JOIN 
            products_details as PD 
        ON 
            PD.product_detail_id = P.product_detail_id 
        where 
            P.product_id = :product_id AND P.user_id = :userId
    ');

    $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
    $stmt->bindParam(':product_id', $id, PDO::PARAM_STR);
    $stmt->execute();

    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
      return null;
    }

    return new Product(
      $product['product_name'],
      $product['product_description'],
      $product['product_image_url'],
      $this->measurementUnitRepository->getMeasurementUnit($product['measurment_unit_id']),
      $product['product_id'],
    );
  }
}