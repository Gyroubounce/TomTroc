<?php

class AuthController {
    private UserManager $userManager;

    public function __construct() {
        $this->userManager = new UserManager();
    }

    /**
     * Formulaire d’inscription
     */
    public function register(): void {
        View::render('auth/register');
    }

    /**
     * Enregistre un nouvel utilisateur
     */
    public function storeRegister(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $email    = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $this->userManager->create($username, $email, $hashedPassword, null);
            header('Location: /connexion');
            exit;
        }
    }

    /**
     * Formulaire de connexion
     */
    public function login(): void {
        View::render('auth/login');
    }

    /**
     * Authentifie un utilisateur
     */
    public function authenticate(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');

            // Recherche uniquement par username
            $user = $this->userManager->findByUsername($username);

            if ($user) {
                // ⚡ On considère l'utilisateur comme connecté
                Session::set('user_id', $user->id);

                // Redirection vers la page Mon compte
                header('Location: /mon-compte');
                exit;
            } else {
                $error = "Utilisateur introuvable";
                View::render('auth/login', ['error' => $error]);
            }
        }
    }



    /**
     * Déconnexion
     */
    public function logout(): void {
        Session::destroy();
        header('Location: /connexion');
        exit;
    }
}
