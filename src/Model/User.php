<?php
    namespace App\Model;

    class User {
        private ?int $id;
        private string $email;
        private string $login;
        private string $passwordHash;

        public function __construct(string $email, string $login, string $passwordHash, ?int $id = null) {
            $this->email = $email;
            $this->login = $login;
            $this->passwordHash = $passwordHash;
            $this->id = $id;
        }

        public function getID(): ?int {
            return $this->id;
        }

        public function getEmail(): string {
            return $this->email;
        }

        public function getLogin(): string {
            return $this->login;
        }

        public function getPasswordHash(): string {
            return $this->passwordHash;
        }

        public function setID(int $id): void {
            $this->id = $id;
        }

        public function setEmail(string $email): void {
            $this->email = $email;
        }

        public function setLogin(string $login): void {
            $this->login = $login;
        }

        public function setPasswordHash(string $password): void {
            $this->passwordHash = $password;
        }

        public function toArray(): array {
            return [
                'id' => $this->id,
                'email' => $this->email,
                'login' => $this->login,
                'password_hash' => $this->passwordHash
            ];
        }
    }
?>