<?php

class User {
    private string $email;
    private string $password;
    private ?string $id;

    public function __construct(string $email, string $password, ?string $id = null) {
        $this->email = $email;
        $this->password = $password;
        $this->id = $id;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email){
        $this->email = $email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password) {
        $this->password = $password;
    }

    public function checkPassword(string $pwd): bool {
      return password_verify($pwd, $this->password);
    }

    public function getId(): string {
      return $this->id;
    }
}
