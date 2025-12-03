<?php
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../models/Book.php';

class BookManager {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function findAll() {
        $stmt = $this->db->query("SELECT * FROM books");
        return $stmt->fetchAll(PDO::FETCH_CLASS, Book::class);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM books WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchObject(Book::class);
    }
}
