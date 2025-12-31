<?php

class MessageManager {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function createMessage(int $senderId, int $receiverId, string $content): int
    {
        $sql = "INSERT INTO messages (sender_id, receiver_id, content, created_at)
                VALUES (:sender, :receiver, :content, NOW())";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'sender'   => $senderId,
            'receiver' => $receiverId,
            'content'  => $content
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function findById(int $id): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch();

        if (!$data) return null;

        return new User($data);
    }

    /**
     * Compte les messages non lus
     */
    public function countUnreadMessages(int $userId): int
    {
        $sql = "SELECT COUNT(*) 
                FROM messages 
                WHERE receiver_id = ? 
                AND is_read = 0";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);

        return (int) $stmt->fetchColumn();
    }


    /**
     * Marque une conversation comme lue
     */
    public function markConversationAsRead(int $userId, int $otherUserId): void
    {
    $sql = "
        UPDATE messages
        SET is_read = 1
        WHERE receiver_id = :user
        AND sender_id = :other
        AND is_read = 0
    ";

    $stmt = $this->db->prepare($sql);
    $stmt->execute([
        'user'  => $userId,
        'other' => $otherUserId
    ]);
    }

    /**
     * 🔥 Liste des conversations (compatible ONLY_FULL_GROUP_BY)
     */
public function getConversations(int $userId): array
{
    $sql = "
        SELECT 
            m.id,
            m.content,
            m.created_at,
            u.id AS other_user_id,
            u.username AS other_username,
            u.profile AS other_profile
        FROM messages m
        JOIN users u 
            ON u.id = CASE 
                        WHEN m.sender_id = :u1 THEN m.receiver_id
                        ELSE m.sender_id
                      END
        WHERE m.id IN (
            SELECT MAX(id)
            FROM messages
            WHERE sender_id = :u2 OR receiver_id = :u3
            GROUP BY LEAST(sender_id, receiver_id), GREATEST(sender_id, receiver_id)
        )
        ORDER BY m.created_at DESC
    ";

    $stmt = $this->db->prepare($sql);
    $stmt->execute([
        'u1' => $userId,
        'u2' => $userId,
        'u3' => $userId
    ]);

    return $stmt->fetchAll(PDO::FETCH_OBJ);
}


    /**
     * 🔥 Messages entre deux utilisateurs
     */
    public function getMessages(int $userId, int $otherUserId): array
    {
        $sql = "
            SELECT *
            FROM messages
            WHERE 
                (sender_id = :u1 AND receiver_id = :u2)
                OR
                (sender_id = :u3 AND receiver_id = :u4)
            ORDER BY created_at ASC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'u1' => $userId,
            'u2' => $otherUserId,
            'u3' => $otherUserId,
            'u4' => $userId
        ]);

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}
