<?php

class MessageController {

    public function start(int $receiverId): void
    {
        if (!Session::has('user_id')) {
            header('Location: /connexion');
            exit;
        }

        // Redirige vers la messagerie avec l'utilisateur ciblé
        header("Location: /messages?user=$receiverId");
        exit;
    }

    public function index(): void
    {
        if (!Session::has('user_id')) {
            header('Location: /connexion');
            exit;
        }

        $userId = Session::get('user_id');

        // Si on vient de la page show → ?user=ID
        $otherUserId = $_GET['other'] ?? null;


        $otherUser = null;
        $messages = [];
        $conversations = [];

        // 🔥 On instancie TON MessageManager
        $messageManager = new MessageManager();

        // 🔥 On récupère la liste des conversations (colonne gauche)
        $conversations = $messageManager->getConversations($userId);

        if ($otherUserId) {

            // 🔥 On récupère l'utilisateur avec qui on parle
            $otherUser = (new UserManager())->findById($otherUserId);

            // 🔥 On récupère les messages entre les deux utilisateurs
            $messages = $messageManager->getMessages($userId, $otherUserId);
            // 🔥 Marque les messages reçus comme lus 
            $messageManager->markConversationAsRead($userId, $otherUserId);
        }

        View::render('messages/index', [
            'currentUser' => (new UserManager())->findById($userId),
            'otherUser'     => $otherUser,
            'messages'      => $messages,
            'conversations' => $conversations
        ]);
    }

    public function sendTo(int $receiverId): void
    {
        if (!Session::has('user_id')) {
            header('Location: /connexion');
            exit;
        }

        $senderId = Session::get('user_id');
        $content = trim($_POST['content']);

        if ($content !== '') {
            $messageManager = new MessageManager();
            $messageManager->createMessage($senderId, $receiverId, $content);
        }

        // Retour à la conversation
        header("Location: /messages?other=$receiverId");
        exit;
    }

}
