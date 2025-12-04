<?php
require_once __DIR__ . '/../models/UserManager.php';

class UserController {
    private $manager;

    public function __construct() {
        $this->manager = new UserManager();
    }

    public function index() {
        $users = $this->manager->findAll();
        require __DIR__ . '/../views/users/index.php';
    }

    public function show($id) {
        $user = $this->manager->findById($id);
        if (!$user) {
            http_response_code(404);
            echo "Utilisateur introuvable";
            return;
        }
        require __DIR__ . '/../views/users/show.php';
    }

    public function create() {
        require __DIR__ . '/../views/users/create.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $email    = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $this->manager->create($username, $email, $password);
            header('Location: /users');
            exit;
        }
    }

    public function delete($id) {
        $this->manager->delete($id);
        header('Location: /users');
        exit;
    }
}
