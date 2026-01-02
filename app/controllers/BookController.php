<?php

class BookController {
    private BookManager $bookManager;
    private UserManager $userManager;
    private ImageManager $imageManager;

    public function __construct() {
        $this->bookManager = new BookManager();
        $this->userManager = new UserManager();
        $this->imageManager = new ImageManager();
    }

    /**
     * Liste les livres (avec recherche éventuelle)
     */
    public function index(): void {
        $search = $_GET['q'] ?? '';

        $books = !empty($search)
            ? $this->bookManager->findByTitle($search)
            : $this->bookManager->findAvailable();

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
            // Option 1 : redirection vers une page 404 personnalisée 
            View::render('errors/404', [ 
                'message' => "Le livre demandé n'existe pas."
            ]); 
            return;
        }

        // ✔️ Utilisation du getter
        $user = $this->userManager->findById($book->getUserId());

        View::render('books/show', [
            'book' => $book,
            'user' => $user
        ]);
    }

    /**
     * Formulaire de création d’un livre
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

          // 🔥 Upload image via ImageManager 
          $imagePath = null; 
          if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) { 
            $imagePath = $this->imageManager->processUpload($_FILES['image'], 'books'); 
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

            // 1️⃣ Récupération du livre
            $book = $this->bookManager->findById($id);

            if (!$book) {
                http_response_code(404);
                echo "Livre introuvable";
                return;
            }

            // 2️⃣ Mise à jour via SETTERS
            $book->setTitle(trim($_POST['title'] ?? ''));
            $book->setAuthor(trim($_POST['author'] ?? ''));
            $book->setDescription(trim($_POST['description'] ?? ''));
            $book->setStatus($_POST['status'] ?? 'disponible');

            // 3️⃣ Mise à jour en base
            $this->bookManager->update($book);

            // 4️⃣ Redirection
            header('Location: /mon-compte');

            exit;
        }
    }



    /**
     * Met à jour l’image d’un livre
     */
    public function updateImage(int $id): void
    {
        if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

            // Traitement complet via ImageManager
            $imagePath = $this->imageManager->processUpload($_FILES['image'], 'books');


            if ($imagePath) {
                $this->bookManager->updateImage($id, $imagePath);
            }
        }

        header("Location: /books/edit/$id");
        exit;
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
