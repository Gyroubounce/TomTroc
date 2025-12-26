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
    /**
     * Authentifie un utilisateur via son email
     */
    public function authenticate(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            // Recherche par email
          // 1. L'utilisateur existe
        $user = $this->userManager->findByEmail($email);

        if (!$user) {
            $error = "Adresse email introuvable";
            View::render('auth/login', ['error' => $error]);
            return;
        }

        // 2. Si le mot de passe est déjà hashé → vérification normale
        if (password_verify($password, $user->password)) {
            Session::set('user_id', $user->id);
            header('Location: /mon-compte');
            exit;
        }

        // 3. Si l'ancien mot de passe était en clair → migration automatique
        if ($password === $user->password) {

            // On re-hash le mot de passe
            $newHash = password_hash($password, PASSWORD_DEFAULT);

            // Mise à jour en base
            $this->userManager->updatePassword($user->id, $newHash);

            // Connexion
            Session::set('user_id', $user->id);
            header('Location: /mon-compte');
            exit;
        }

        // 4. Sinon → mauvais mot de passe
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
