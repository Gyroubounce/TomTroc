<?php

class Message
{
    // --- PROPRIÉTÉS PRIVÉES ---
    private int $id;
    private int $sender_id;
    private int $receiver_id;
    private string $content;


    // --- GETTERS ---

    public function getId(): int {
        return $this->id;
    }

    public function getSenderId(): int {
        return $this->sender_id;
    }

    public function getReceiverId(): int {
        return $this->receiver_id;
    }

    public function getContent(): string {
        return $this->content;
    }


    // --- SETTERS (UNIQUEMENT POUR LE CONTENU) ---

    public function setContent(string $content): void {
        $this->content = $content;
    }
}
