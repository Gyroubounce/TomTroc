<?php

class Book
{
    // --- PROPRIÉTÉS PRIVÉES ---
    private int $id;
    private string $title;
    private ?string $author;
    private ?string $description;
    private string $status;
    private ?string $image;
    private int $user_id;

    private ?User $user = null;


    // --- GETTERS ---

    public function getId(): int {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getAuthor(): ?string {
        return $this->author;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getImage(): ?string {
        return $this->image;
    }

    public function getUserId(): int {
        return $this->user_id;
    }

    public function getUser(): ?User {
        return $this->user;
    }


    // --- SETTERS (UNIQUEMENT POUR L'ÉDITION) ---

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function setAuthor(?string $author): void {
        $this->author = $author;
    }

    public function setDescription(?string $description): void {
        $this->description = $description;
    }

    public function setStatus(string $status): void {
        $this->status = $status;
    }

    public function setImage(?string $image): void {
        $this->image = $image;
    }

    public function setUser(?User $user): void {
        $this->user = $user;
    }
}
