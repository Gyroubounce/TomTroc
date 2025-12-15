<?php
require_once __DIR__ . '/../managers/BookManager.php';
require_once __DIR__ . '/../managers/UserManager.php';

class BookController {
    private $bookManager;
    private $userManager;

    public function __construct() {
        $this->bookManager = new BookManager();
        $this->userManager = new UserManager();
    }

    /**
     * Liste les livres (avec recherche éventuelle)
     */
    public function index() {
        $search = $_GET['q'] ?? '';

        if (!empty($search)) {
            $books = $this->bookManager->findByTitle($search);
        } else {
            $books = $this->bookManager->findAvailable();
        }

        include __DIR__ . '/../views/partials/header.php';
        include __DIR__ . '/../views/books/index.php';
        include __DIR__ . '/../views/partials/footer.php';
    }

    /**
     * Affiche un livre par son ID avec son propriétaire
     */
    public function show($id) {
        $book = $this->bookManager->findById($id);

        if (!$book) {
            http_response_code(404);
            echo "Livre introuvable";
            return;
        }

        // 🔎 récupérer le user correspondant
        $user = $this->userManager->findById($book->user_id);

        include __DIR__ . '/../views/partials/header.php';
        include __DIR__ . '/../views/books/show.php';
        include __DIR__ . '/../views/partials/footer.php';
    }
}
