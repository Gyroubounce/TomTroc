<?php

class MessageController {
    private MessageManager $messageManager;

    public function __construct() {
        $this->messageManager = new MessageManager();
    }

    /**
     * Page principale de la messagerie :
     * - colonne gauche : liste des conversations
     * - colonne droite : messages de la conversation sélectionnée (si ?conversation=ID)
     */
    public function index(): void {
        if (!Session::has('user_id')) {
            header('Location: /connexion');
            exit;
        }

        $userId = Session::get('user_id');

        // Liste des conversations de l'utilisateur connecté
        $conversations = $this->messageManager->findConversationsByUser($userId);

        $messages  = null;
        $otherUser = null;

        // Si une conversation est sélectionnée via ?conversation=ID
        if (isset($_GET['conversation'])) {
            $otherUserId = (int)$_GET['conversation'];

            $otherUser = (new UserManager())->findById($otherUserId);
            $messages  = $this->messageManager->findMessagesBetween($userId, $otherUserId);
        }

        View::render('messages/index', [
            'conversations' => $conversations,
            'messages'      => $messages,
            'otherUser'     => $otherUser,
            'user'          => (new UserManager())->findById($userId),
        ]);
    }

    /**
     * Envoi d’un message à un autre utilisateur
     * => retour sur /messages avec la même conversation ouverte
     */
    public function sendToUser(int $otherUserId): void {
        if (!Session::has('user_id')) {
            header('Location: /connexion');
            exit;
        }

        $senderId = Session::get('user_id');
        $content  = trim($_POST['content'] ?? '');

        if (!empty($content)) {
            $this->messageManager->sendBetweenUsers($senderId, $otherUserId, $content);
        }

        // On revient sur la page messages/index.php avec la conversation ouverte
        header('Location: /messages?conversation=' . $otherUserId);
        exit;
    }
}
