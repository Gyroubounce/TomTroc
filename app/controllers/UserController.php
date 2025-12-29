<?php

class UserController {
    private UserManager $manager;

    public function __construct() {
        $this->manager = new UserManager();
    }

    /**
     * Liste tous les utilisateurs (admin)
     */
    public function index(): void {
        $users = $this->manager->findAll();
        View::render('users/index', ['users' => $users]);
    }

    /**
     * Affiche un utilisateur par ID
     */
    public function show(int $id): void {
        $user = $this->manager->findById($id);
        if (!$user) {
            http_response_code(404);
            echo "Utilisateur introuvable";
            return;
        }
        View::render('users/show', ['user' => $user]);
    }

    /**
     * Formulaire d’édition (admin)
     */
    public function edit(int $id): void {
        $user = $this->manager->findById($id);
        if (!$user) {
            http_response_code(404);
            echo "Utilisateur introuvable";
            return;
        }
        View::render('users/edit', ['user' => $user]);
    }

    /**
     * Met à jour un utilisateur (admin)
     */
    public function update(int $id): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email    = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;
            $username = $_POST['username'] ?? null;

            // Mise à jour des infos utilisateur
            $this->manager->updateUser($id, $email, $password, $username);

            // Gestion de la photo
            if (!empty($_FILES['profile']['name'])) {

                $uploadDir = __DIR__ . '/../../public/assets/uploads/profile/';
                $fileName  = basename($_FILES['profile']['name']);
                $target    = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['profile']['tmp_name'], $target)) {
                    // ⚠️ Méthode à ajouter dans UserManager
                    $this->manager->updateProfile($id, $fileName);
                }
            }

            header('Location: /mon-compte');
            exit;
        }
    }

    /**
     * Supprime un utilisateur (admin)
     */
    public function delete(int $id): void {
        $this->manager->delete($id);
        header('Location: /users');
        exit;
    }

    /**
     * Affiche le compte de l’utilisateur connecté
     */
    public function account(): void {
        if (!Session::has('user_id')) {
            header('Location: /connexion');
            exit;
        }

        $userId = Session::get('user_id');
        $user = $this->manager->findById($userId);

        if (!$user) {
            http_response_code(404);
            echo "Utilisateur introuvable";
            return;
        }

        // ✔️ Correction ici
        $bookManager = new BookManager();
        $books = $bookManager->findByUser($userId);

        View::render('users/account', [
            'user'  => $user,
            'books' => $books
        ]);
    }

    /**
     * Affiche le profil public d’un utilisateur
     */
    public function profil(int $userId): void {
        $user  = (new UserManager())->findById($userId);
        $books = (new BookManager())->findByUser($userId);

        View::render('users/profil', [
            'user'  => $user,
            'books' => $books
        ]);
    }
    
}
