<?php
require_once __DIR__ . '/../managers/BookManager.php';

class BookController {
      private $manager;

    public function __construct() {
        $this->manager = new BookManager();
    }

    public function index() {
        // Récupération du paramètre de recherche
        $search = $_GET['q'] ?? '';

        if (!empty($search)) {
            $books = $this->manager->findByTitle($search);
        } else {
            $books = $this->manager->findAvailable();
        }
        include __DIR__ . '/../views/partials/header.php';
        include __DIR__ . '/../views/books/index.php';
        include __DIR__ . '/../views/partials/footer.php';
    }
       public function show($id) {
        $manager = new BookManager();
        $book = $manager->findById($id);

        include __DIR__ . '/../views/partials/header.php';
        include __DIR__ . '/../views/books/show.php';
        include __DIR__ . '/../views/partials/footer.php';
    }
}
