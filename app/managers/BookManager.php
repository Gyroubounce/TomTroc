<?php
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../models/Book.php';

class BookManager {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // Tous les livres avec pseudo du vendeur
    public function findAll() {
        $sql = "SELECT b.*, u.username AS seller
                FROM books b
                JOIN users u ON b.user_id = u.id";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, Book::class);
    }

    // Livres disponibles avec pseudo du vendeur
    public function findAvailable() {
        $sql = "SELECT b.*, u.username AS seller
                FROM books b
                JOIN users u ON b.user_id = u.id
                WHERE b.status = 'disponible'";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Livre par ID avec pseudo du vendeur
    public function findById($id) {
        $sql = "SELECT b.*, u.username AS seller
                FROM books b
                JOIN users u ON b.user_id = u.id
                WHERE b.id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchObject(Book::class);
    }

    // Recherche par titre avec pseudo du vendeur
    public function findByTitle($title) {
        $sql = "SELECT b.*, u.username AS seller
                FROM books b
                JOIN users u ON b.user_id = u.id
                WHERE b.status = 'disponible' AND b.title LIKE ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['%' . $title . '%']);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
