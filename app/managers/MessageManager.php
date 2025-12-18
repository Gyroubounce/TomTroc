<?php
class MessageManager {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // Messages reçus par un utilisateur
    public function findReceived(int $userId): array {
        $stmt = $this->db->prepare("
            SELECT m.*, u.username AS sender_name, b.title AS book_title
            FROM messages m
            JOIN users u ON m.sender_id = u.id
            LEFT JOIN books b ON m.book_id = b.id
            WHERE m.receiver_id = :userId
            ORDER BY m.created_at DESC
        ");
        $stmt->execute(['userId' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Conversation entre deux utilisateurs
    public function findConversation(int $userId, int $otherUserId): array {
        $stmt = $this->db->prepare("
            SELECT m.*, u.username AS sender_name
            FROM messages m
            JOIN users u ON m.sender_id = u.id
            WHERE (m.sender_id = :userId AND m.receiver_id = :otherUserId)
               OR (m.sender_id = :otherUserId AND m.receiver_id = :userId)
            ORDER BY m.created_at ASC
        ");
        $stmt->execute([
            'userId'      => $userId,
            'otherUserId' => $otherUserId
        ]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Conversation autour d’un livre
    public function findByBook(int $bookId): array {
        $stmt = $this->db->prepare("
            SELECT m.*, u.username AS sender_name
            FROM messages m
            JOIN users u ON m.sender_id = u.id
            WHERE m.book_id = :bookId
            ORDER BY m.created_at ASC
        ");
        $stmt->execute(['bookId' => $bookId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Envoi d’un message (avec ou sans livre)
    public function send(int $senderId, int $receiverId, string $content, ?int $bookId = null): void {
        $stmt = $this->db->prepare("
            INSERT INTO messages (sender_id, receiver_id, book_id, content, created_at)
            VALUES (:senderId, :receiverId, :bookId, :content, NOW())
        ");
        $stmt->execute([
            'senderId'   => $senderId,
            'receiverId' => $receiverId,
            'bookId'     => $bookId,
            'content'    => $content
        ]);
    }

    // Récupérer toutes les conversations d’un utilisateur
    public function findConversationsByUser(int $userId): array {
        $stmt = $this->db->prepare("
            SELECT m.id, m.content, m.created_at,
                u.id AS other_user_id,
                u.username AS other_username,
                u.profile AS other_profile
            FROM messages m
            JOIN users u 
            ON (CASE 
                    WHEN m.sender_id = :userId THEN m.receiver_id = u.id
                    ELSE m.sender_id = u.id
                END)
            WHERE m.id IN (
                SELECT MAX(id) 
                FROM messages 
                WHERE sender_id = :userId OR receiver_id = :userId
                GROUP BY LEAST(sender_id, receiver_id), GREATEST(sender_id, receiver_id)
            )
            ORDER BY m.created_at DESC
        ");
        $stmt->execute(['userId' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

   // Récupérer les messages entre deux utilisateurs
    public function findMessagesBetween(int $userId, int $otherUserId): array {
    $stmt = $this->db->prepare("
        SELECT m.id, m.content, m.created_at, m.sender_id, m.receiver_id
        FROM messages m
        WHERE (m.sender_id = :userId AND m.receiver_id = :otherUserId)
           OR (m.sender_id = :otherUserId AND m.receiver_id = :userId)
        ORDER BY m.created_at ASC
    ");
    $stmt->execute([
        'userId' => $userId,
        'otherUserId' => $otherUserId
    ]);
    return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
