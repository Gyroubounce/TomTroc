<?php
class Book {
    public int $id;
    public string $title;
    public ?string $author;       // peut être NULL
    public ?string $description;  // peut être NULL
    public string $status;        // 'disponible' ou 'non dispo'
    public ?string $image;        // peut être NULL
    public int $user_id;

    public ?User $user = null;
}

