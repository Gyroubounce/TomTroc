<?php
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../models/Message.php';

class MessageManager {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function findAll() {
        $stmt = $this->db->query("SELECT * FROM messages");
        return $stmt->fetchAll(PDO::FETCH_CLASS, Message::class);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM messages WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchObject(Message::class);
    }
}
