<?php

class BookController {
    private BookManager $bookManager;
    private UserManager $userManager;

    public function __construct() {
        $this->bookManager = new BookManager();
        $this->userManager = new UserManager();
    }

    /**
     * Liste les livres (avec recherche éventuelle)
     */
    public function index(): void {
        $search = $_GET['q'] ?? '';

        if (!empty($search)) {
            $books = $this->bookManager->findByTitle($search);
        } else {
            $books = $this->bookManager->findAvailable();
        }

        View::render('books/index', ['books' => $books]);
    }

    /**
     * Affiche un livre par son ID avec son propriétaire
     */
    public function show(int $id): void {
        if (!Session::has('user_id')) {
            header('Location: /connexion');
            exit;
        }

        $book = $this->bookManager->findById($id);

        if (!$book) {
            http_response_code(404);
            echo "Livre introuvable";
            return;
        }

        $user = $this->userManager->findById($book->user_id);

        View::render('books/show', [
            'book' => $book,
            'user' => $user
        ]);
    }


    /**
     * Formulaire de création d’un livre (protégé par session)
     */
    public function create(): void {
        if (!Session::has('user_id')) {
            header('Location: /connexion');
            exit;
        }

        View::render('books/create');
    }

    /**
     * Enregistre un nouveau livre
     */
    public function store(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Session::has('user_id')) {
                header('Location: /connexion');
                exit;
            }

            $title       = trim($_POST['title'] ?? '');
            $author      = trim($_POST['author'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $status      = 'disponible';
            $userId      = Session::get('user_id');

            // Gestion de l’upload d’image
            $image = null;
            if (!empty($_FILES['image']['name'])) {
                $uploadDir  = __DIR__ . '/../../public/assets/uploads/books/';
                $fileName   = basename($_FILES['image']['name']);
                $targetPath = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    $image = $fileName;
                }
            }

            $this->bookManager->create($title, $author, $description, $status, $userId, $image);
            header('Location: /books');
            exit;
        }
    }

    /**
     * Formulaire d’édition d’un livre
     */
    public function edit(int $id): void {
        if (!Session::has('user_id')) {
            header('Location: /connexion');
            exit;
        }

        $book = $this->bookManager->findById($id);
        if (!$book) {
            http_response_code(404);
            echo "Livre introuvable";
            return;
        }

        View::render('books/edit', ['book' => $book]);
    }

    /**
     * Met à jour un livre
     */
    public function update(int $id): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Session::has('user_id')) {
                header('Location: /connexion');
                exit;
            }

            $status = $_POST['status'] ?? 'disponible';
            $this->bookManager->updateStatus($id, $status);

            header('Location: /books/' . $id);
            exit;
        }
    }

    /**
     * Supprime un livre
     */
    public function delete(int $id): void {
        if (!Session::has('user_id')) {
            header('Location: /connexion');
            exit;
        }

        $this->bookManager->delete($id);
        header('Location: /books');
        exit;
    }
}
