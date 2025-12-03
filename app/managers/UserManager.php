<?php
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../models/User.php';

class UserManager {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function findAll() {
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_CLASS, User::class);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchObject(User::class);
    }
}
