<?php

class BookManager {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    /**
     * Hydrate un Book + son User complet
     */
    private function hydrateBook(array $row): Book {
        $book = new Book();

        // Hydratation du Book
        $book->setTitle($row['title']);
        $book->setAuthor($row['author']);
        $book->setDescription($row['description']);
        $book->setStatus($row['status']);
        $book->setImage($row['image']);

        // Hydratation des propriétés privées id et user_id
        $ref = new ReflectionClass($book);

        $idProp = $ref->getProperty('id');
        $idProp->setAccessible(true);
        $idProp->setValue($book, (int)$row['id']);

        $userIdProp = $ref->getProperty('user_id');
        $userIdProp->setAccessible(true);
        $userIdProp->setValue($book, (int)$row['user_id']);

        // Hydratation complète du User via UserManager
        $userManager = new UserManager();
        $user = $userManager->findById((int)$row['user_id']);

        // On rattache le User complet au Book
        $book->setUser($user);

        return $book;
    }

    /**
     * Récupère tous les livres avec leur vendeur
     */
    public function findAll(): array {
        $sql = "SELECT * FROM books ORDER BY id DESC";
        $stmt = $this->db->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map([$this, 'hydrateBook'], $rows);
    }

    /**
     * Récupère les livres disponibles
     */
    public function findAvailable(): array {
        $sql = "SELECT * FROM books WHERE status = 'disponible' ORDER BY id DESC";
        $stmt = $this->db->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map([$this, 'hydrateBook'], $rows);
    }

    /**
     * Récupère un livre par ID
     */
    public function findById(int $id): ?Book {
        $sql = "SELECT * FROM books WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? $this->hydrateBook($row) : null;
    }

    /**
     * Recherche par titre
     */
    public function findByTitle(string $title): array {
        $sql = "SELECT * FROM books 
                WHERE status = 'disponible' 
                AND title LIKE ?
                ORDER BY id DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['%' . $title . '%']);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map([$this, 'hydrateBook'], $rows);
    }

    /**
     * Création
     */
    public function create(string $title, ?string $author, ?string $description, string $status, int $userId, ?string $image): void {
        $sql = "INSERT INTO books (title, author, description, status, user_id, image)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$title, $author, $description, $status, $userId, $image]);
    }

    /**
     * Mise à jour
     */
    public function update(Book $book): bool {
        $sql = "UPDATE books 
                SET title = :title,
                    author = :author,
                    description = :description,
                    status = :status,
                    image = :image
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':title' => $book->getTitle(),
            ':author' => $book->getAuthor(),
            ':description' => $book->getDescription(),
            ':status' => $book->getStatus(),
            ':image' => $book->getImage(),
            ':id' => $book->getId()
        ]);
    }


    /**
     * Met à jour l’image d’un livre
     */
    public function updateImage(int $id, string $fileName): void {
        $stmt = $this->db->prepare("UPDATE books SET image = ? WHERE id = ?");
        $stmt->execute([$fileName, $id]);
    }


    /**
     * Suppression
     */
    public function delete(int $id): void {
        $stmt = $this->db->prepare("DELETE FROM books WHERE id = ?");
        $stmt->execute([$id]);
    }

    /**
     * Livres d’un utilisateur
     */
    public function findByUser(int $userId): array {
        $sql = "SELECT * FROM books 
                WHERE user_id = ?
                ORDER BY id DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map([$this, 'hydrateBook'], $rows);
    }

    /**
     * Récupère les derniers livres disponibles
     */
    public function findLatest(int $limit = 4): array {
        $sql = "SELECT * FROM books
                WHERE status = 'disponible'
                ORDER BY id DESC
                LIMIT ?";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map([$this, 'hydrateBook'], $rows);
    }
}
