<?php
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../models/Book.php';
require_once __DIR__ . '/../models/User.php';

class BookManager {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    /**
     * Hydrate un objet Book avec son User (vendeur)
     */
    private function hydrateBook(array $row): Book {
        $book = new Book();
        $book->id = (int)$row['id'];
        $book->title = $row['title'];
        $book->author = $row['author'];
        $book->description = $row['description'];
        $book->status = $row['status'];
        $book->user_id = (int)$row['user_id'];
        $book->image = $row['image'];

        // Hydrate l'objet User (vendeur)
        $user = new User();
        $user->id = (int)$row['user_id'];
        $user->username = $row['username'];
        $user->email = $row['email'];
        $user->profile = $row['profile'];


        return $book;
    }

    /**
     * Récupère tous les livres avec leur vendeur
     */
    public function findAll(): array {
        $sql = "SELECT b.*, u.id AS user_id, u.username, u.email, u.profile
                FROM books b
                JOIN users u ON b.user_id = u.id";
        $stmt = $this->db->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $books = [];
        foreach ($rows as $row) {
            $books[] = $this->hydrateBook($row);
        }
        return $books;
    }

    /**
     * Récupère les livres disponibles avec leur vendeur
     */
    public function findAvailable(): array {
        $sql = "SELECT b.*, u.id AS user_id, u.username, u.email, u.profile
                FROM books b
                JOIN users u ON b.user_id = u.id
                WHERE b.status = 'disponible'";
        $stmt = $this->db->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $books = [];
        foreach ($rows as $row) {
            $books[] = $this->hydrateBook($row);
        }
        return $books;
    }

    /**
     * Récupère un livre par son ID avec son vendeur
     */
    public function findById(int $id): ?Book {
        $sql = "SELECT b.*, u.id AS user_id, u.username, u.email, u.profile
                FROM books b
                JOIN users u ON b.user_id = u.id
                WHERE b.id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? $this->hydrateBook($row) : null;
    }

    /**
     * Recherche des livres par titre (uniquement disponibles)
     */
    public function findByTitle(string $title): array {
        $sql = "SELECT b.*, u.id AS user_id, u.username, u.email, u.profile
                FROM books b
                JOIN users u ON b.user_id = u.id
                WHERE b.status = 'disponible' AND b.title LIKE ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['%' . $title . '%']);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $books = [];
        foreach ($rows as $row) {
            $books[] = $this->hydrateBook($row);
        }
        return $books;
    }

    /**
     * Crée un nouveau livre
     */
    public function create(string $title, string $author, string $description, string $status, int $userId, ?string $image = null): void {
        $sql = "INSERT INTO books (title, author, description, status, user_id, image)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$title, $author, $description, $status, $userId, $image]);
    }

    /**
     * Met à jour le statut d’un livre
     */
    public function updateStatus(int $id, string $status): void {
        $stmt = $this->db->prepare("UPDATE books SET status = ? WHERE id = ?");
        $stmt->execute([$status, $id]);
    }

    /**
     * Supprime un livre
     */
    public function delete(int $id): void {
        $stmt = $this->db->prepare("DELETE FROM books WHERE id = ?");
        $stmt->execute([$id]);
    }

    /**
     * Récupère les derniers livres ajoutés (disponibles)
     */
    public function findLatest(int $limit = 4): array
    {
        $sql = "
            SELECT b.*, u.id AS user_id, u.username, u.email, u.profile
            FROM books b
            JOIN users u ON b.user_id = u.id
            WHERE b.status = 'disponible'
            ORDER BY b.id DESC
            LIMIT ?
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $books = [];
        foreach ($rows as $row) {
            $books[] = $this->hydrateBook($row);
        }

        return $books;
    }

}
