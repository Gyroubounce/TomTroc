<?php


class UserManager {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    /**
     * Récupère tous les utilisateurs
     * @return User[]
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
        $user = $stmt->fetchObject(User::class);
        return $user ?: null;
    }

    /**
     * Récupère un utilisateur par son username
     */
    public function findByUsername(string $username): ?User {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetchObject(User::class);
        return $user ?: null;
    }

    /**
     * Récupère un utilisateur par son email
     */
    public function findByEmail(string $email): ?User {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetchObject(User::class);
        return $user ?: null;
    }

    public function findByUsernameAndEmail(string $username, string $email): ?object {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username AND email = :email");
        $stmt->execute([
            'username' => $username,
            'email'    => $email
        ]);

        $user = $stmt->fetchObject(User::class);


        return $user ?: null;
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
    public function updateUser(int $id, string $email, ?string $password, string $username): void
    {
        // Si le mot de passe est vide → on ne le modifie pas
        if (empty($password)) {
            $stmt = $this->db->prepare("
                UPDATE users 
                SET email = ?, username = ?
                WHERE id = ?
            ");
            $stmt->execute([$email, $username, $id]);
            return;
        }

        // Sinon → on met à jour le mot de passe aussi
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("
            UPDATE users 
            SET email = ?, username = ?, password = ?
            WHERE id = ?
        ");
        $stmt->execute([$email, $username, $hashed, $id]);
    }

    /**
     * Supprime un utilisateur
     */
    public function delete(int $id): void {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    }
}
