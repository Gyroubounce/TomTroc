<?php
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../models/User.php';

class UserManager {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    /**
     * Récupère tous les utilisateurs
     */
    public function findAll(): array {
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_CLASS, User::class);
    }

    /**
     * Récupère un utilisateur par son ID
     */
    public function findById(int $id): ?User {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchObject(User::class) ?: null;
    }

    /**
     * Récupère un utilisateur par son username
     */
    public function findByUsername(string $username): ?User {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetchObject(User::class) ?: null;
    }

    /**
     * Crée un nouvel utilisateur
     */
    public function create(string $username, string $email, string $password, ?string $profile = null): void {
        $stmt = $this->db->prepare(
            "INSERT INTO users (username, email, password, profile) VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([
            $username,
            $email,
            password_hash($password, PASSWORD_DEFAULT),
            $profile
        ]);
    }

    /**
     * Met à jour la photo de profil d’un utilisateur
     */
    public function updateProfile(int $id, string $profile): void {
        $stmt = $this->db->prepare("UPDATE users SET profile = ? WHERE id = ?");
        $stmt->execute([$profile, $id]);
    }

    /**
     * Supprime un utilisateur
     */
    public function delete(int $id): void {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    }
}
