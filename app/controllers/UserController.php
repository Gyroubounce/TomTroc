<?php
require_once __DIR__ . '/../models/UserManager.php';

class UserController {
    private $manager;

    public function __construct() {
        $this->manager = new UserManager();
    }

    /**
     * Liste tous les utilisateurs
     */
    public function index() {
        $users = $this->manager->findAll();
        require __DIR__ . '/../views/users/index.php';
    }

    /**
     * Affiche un utilisateur par ID
     */
    public function show($id) {
        $user = $this->manager->findById($id);
        if (!$user) {
            http_response_code(404);
            echo "Utilisateur introuvable";
            return;
        }
        require __DIR__ . '/../views/users/show.php';
    }

    /**
     * Formulaire de création
     */
    public function create() {
        require __DIR__ . '/../views/users/create.php';
    }

    /**
     * Enregistre un nouvel utilisateur
     */
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $email    = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            // Gestion de l'upload de l'image de profil
            $profile = null;
            if (!empty($_FILES['profile']['name'])) {
                $uploadDir = __DIR__ . '/../../public/assets/uploads/profile/';
                $fileName = basename($_FILES['profile']['name']);
                $targetPath = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['profile']['tmp_name'], $targetPath)) {
                    $profile = $fileName;
                }
            }

            $this->manager->create($username, $email, $password, $profile);
            header('Location: /users');
            exit;
        }
    }

    /**
     * Formulaire d’édition
     */
    public function edit($id) {
        $user = $this->manager->findById($id);
        if (!$user) {
            http_response_code(404);
            echo "Utilisateur introuvable";
            return;
        }
        require __DIR__ . '/../views/users/edit.php';
    }

    /**
     * Met à jour un utilisateur
     */
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $profile = null;
            if (!empty($_FILES['profile']['name'])) {
                $uploadDir = __DIR__ . '/../../public/assets/uploads/profile/';
                $fileName = basename($_FILES['profile']['name']);
                $targetPath = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['profile']['tmp_name'], $targetPath)) {
                    $profile = $fileName;
                }
            }

            if ($profile) {
                $this->manager->updateProfile($id, $profile);
            }
            header('Location: /users/' . $id);
            exit;
        }
    }

    /**
     * Supprime un utilisateur
     */
    public function delete($id) {
        $this->manager->delete($id);
        header('Location: /users');
        exit;
    }
}
