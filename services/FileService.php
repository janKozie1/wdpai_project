<?php

class FileService {
  private string $uploadDirectory;

  public function __construct(string $uploadDirectory) {
    $this->uploadDirectory = $uploadDirectory;
  }

  private function getRandomFileName(): string {
    return uniqid();
  }

  public function saveUploadedFile(array $file): string {
    $fileInfo = pathinfo($file['name']);

    $fileName = $this->getRandomFileName().'.'.$fileInfo['extension'];
    $target = '/app'.$this->uploadDirectory.$fileName;

    move_uploaded_file($file['tmp_name'], $target);

    return $fileName;
  }
}