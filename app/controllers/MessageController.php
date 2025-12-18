<?php

class MessageController {
    private MessageManager $messageManager;

    public function __construct() {
        $this->messageManager = new MessageManager();
    }

    /**
     * Liste des messages reçus
     */
    public function index(): void {
    if (!Session::has('user_id')) {
        header('Location: /connexion');
        exit;
    }

    $userId = Session::get('user_id');
    $conversations = (new MessageManager())->findConversationsByUser($userId);

    $messages = null;
    $otherUser = null;

    if (isset($_GET['conversation'])) {
        $otherUserId = (int)$_GET['conversation'];
        $otherUser = (new UserManager())->findById($otherUserId);
        $messages = (new MessageManager())->findMessagesBetween($userId, $otherUserId);
    }

    View::render('messages/index', [
        'conversations' => $conversations,
        'messages' => $messages,
        'otherUser' => $otherUser,
        'user' => (new UserManager())->findById($userId)
    ]);
}



    /**
     * Fil de discussion autour d’un livre
     */
    public function discussion(int $bookId): void {
        if (!Session::has('user_id')) {
            header('Location: /connexion');
            exit;
        }

        $book     = (new BookManager())->findById($bookId);
        $messages = $this->messageManager->findByBook($bookId);

        View::render('messages/conversation', [
            'book'     => $book,
            'messages' => $messages,
            'user'     => (new UserManager())->findById(Session::get('user_id'))
        ]);
    }

    /**
     * Formulaire pour écrire un nouveau message
     */
    public function create(): void {
        if (!Session::has('user_id')) {
            header('Location: /connexion');
            exit;
        }

        View::render('messages/create', [
            'user' => (new UserManager())->findById(Session::get('user_id'))
        ]);
    }

        // Fil de discussion avec un autre utilisateur
    public function conversation(int $otherUserId): void {
        if (!Session::has('user_id')) {
            header('Location: /connexion');
            exit;
        }

        $userId   = Session::get('user_id');
        $messages = $this->messageManager->findConversation($userId, $otherUserId);

        View::render('messages/conversation', [
            'messages'   => $messages,
            'user'       => (new UserManager())->findById($userId),
            'otherUser'  => (new UserManager())->findById($otherUserId)
        ]);
    }

    /**
     * Envoi d’un message
     */
    public function send(int $bookId): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Session::has('user_id')) {
                header('Location: /connexion');
                exit;
            }

            $senderId = Session::get('user_id');
            $content  = trim($_POST['content'] ?? '');

            if (!empty($content)) {
                $this->messageManager->send($senderId, $bookId, $content);
            }

            header('Location: /messages/book/' . $bookId);
            exit;
        }
    }


}
