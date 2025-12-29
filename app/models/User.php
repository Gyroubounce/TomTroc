<?php

class User {

    private int $id;
    private string $username;
    private string $email;
    private string $password;
    private string $created_at;
    private ?string $profile;

    // --- GETTERS ---

    public function getId(): int {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getCreatedAt(): string {
        return $this->created_at;
    }

    public function getProfile(): ?string {
        return $this->profile;
    }

    // --- SETTERS ---

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function setCreatedAt(string $created_at): void {
        $this->created_at = $created_at;
    }

    public function setProfile(?string $profile): void {
        $this->profile = $profile;
    }
}
