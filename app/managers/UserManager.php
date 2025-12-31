<?php

class UserManager {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    /**
     * Hydrate un objet User à partir d'un tableau SQL
     */
    private function hydrateUser(array $row): User {
        $user = new User();

        $user->setId($row['id']);
        $user->setUsername($row['username']);
        $user->setEmail($row['email']);
        $user->setPassword($row['password']);
        $user->setCreatedAt($row['created_at']);
        $user->setProfile($row['profile']);

        return $user;
    }

    /**
     * Récupère tous les utilisateurs
     * @return User[]
     */
    public function findAll(): array {
        $stmt = $this->db->query("SELECT * FROM users");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = [];
        foreach ($rows as $row) {
            $users[] = $this->hydrateUser($row);
        }
        return $users;
    }

    /**
     * Récupère un utilisateur par son ID
     */
    public function findById(int $id): ?User {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? $this->hydrateUser($row) : null;
    }

    /**
     * Récupère un utilisateur par son username
     */
    public function findByUsername(string $username): ?User {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? $this->hydrateUser($row) : null;
    }

    /**
     * Récupère un utilisateur par son email
     */
    public function findByEmail(string $email): ?User {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? $this->hydrateUser($row) : null;
    }

    /**
     * Récupère un utilisateur par username + email
     */
    public function findByUsernameAndEmail(string $username, string $email): ?User {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username AND email = :email");
        $stmt->execute([
            'username' => $username,
            'email'    => $email
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? $this->hydrateUser($row) : null;
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
            $password,
            $profile
        ]);
    }

    /**
     * Met à jour email / username / password (tous optionnels)
     */
    public function updateUser(int $id, ?string $email, ?string $password, ?string $username): void
    {
        $fields = [];
        $params = [];

        if ($email !== null) {
            $fields[] = "email = ?";
            $params[] = $email;
        }

        if ($username !== null) {
            $fields[] = "username = ?";
            $params[] = $username;
        }

        if ($password !== null && $password !== "") {
            $fields[] = "password = ?";
            $params[] = password_hash($password, PASSWORD_DEFAULT);
        }

        // Aucun champ à mettre à jour → on ne fait rien
        if (empty($fields)) {
            return;
        }

        $sql = "UPDATE users SET " . implode(', ', $fields) . " WHERE id = ?";
        $params[] = $id;

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
    }

    /**
     * Met à jour uniquement la photo de profil
     */
    public function updateProfile(int $id, string $fileName): void {
        $stmt = $this->db->prepare("UPDATE users SET profile = ? WHERE id = ?");
        $stmt->execute([$fileName, $id]);
    }

    /**
     * Met à jour uniquement le mot de passe
     */
    public function updatePassword(int $id, string $hash): void {
        $stmt = $this->db->prepare("UPDATE users SET password = :password WHERE id = :id");
        $stmt->execute([
            'password' => $hash,
            'id' => $id
        ]);
    }

    /**
     * Supprime un utilisateur
     */
    public function delete(int $id): void {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    }
}
