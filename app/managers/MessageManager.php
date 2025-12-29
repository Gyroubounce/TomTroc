<?php

class MessageManager {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    /**
     * Récupère toutes les conversations d’un utilisateur
     * (une ligne par conversation, triée par dernier message)
     */
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

    /**
     * Récupère tous les messages entre deux utilisateurs
     */
    public function findMessagesBetween(int $userId, int $otherUserId): array {
        $stmt = $this->db->prepare("
            SELECT m.id, m.content, m.created_at, m.sender_id, m.receiver_id
            FROM messages m
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

    /**
     * Envoi d’un message entre deux utilisateurs
     */
    public function sendBetweenUsers(int $senderId, int $receiverId, string $content): void {
        $stmt = $this->db->prepare("
            INSERT INTO messages (sender_id, receiver_id, content, created_at)
            VALUES (?, ?, ?, NOW())
        ");
        $stmt->execute([$senderId, $receiverId, $content]);
    }


    /**
     * Compte le nombre de messages non lus pour un utilisateur
     */
    public function countUnreadMessages(int $userId): int {
    $stmt = $this->db->prepare("
        SELECT COUNT(*) 
        FROM messages 
        WHERE receiver_id = ? 
        AND is_read = 0
    ");
    $stmt->execute([$userId]);
    return (int) $stmt->fetchColumn();
    }

}
