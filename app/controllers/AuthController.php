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
     * Authentifie un utilisateur via son email
     */
    public function authenticate(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            // 1. Recherche par email
            $user = $this->userManager->findByEmail($email);

            if (!$user) {
                $error = "Adresse email introuvable";
                View::render('auth/login', ['error' => $error]);
                return;
            }

            // 2. Vérification du mot de passe hashé
            if (password_verify($password, $user->getPassword())) {
                Session::set('user_id', $user->getId());
                header('Location: /mon-compte');
                exit;
            }

            // 3. Migration automatique si ancien mot de passe en clair
            if ($password === $user->getPassword()) {

                $newHash = password_hash($password, PASSWORD_DEFAULT);

                $this->userManager->updatePassword($user->getId(), $newHash);

                Session::set('user_id', $user->getId());
                header('Location: /mon-compte');
                exit;
            }

            // 4. Mauvais mot de passe
            $error = "Mot de passe incorrect";
            View::render('auth/login', ['error' => $error]);
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
