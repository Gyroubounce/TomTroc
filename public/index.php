<?php
// Front controller : point d’entrée unique

// 1. Config & session
require __DIR__ . '/../app/core/Session.php';
Session::start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// 2. Autoload
require __DIR__ . '/../app/core/autoload.php';

// 3. Installer (si nécessaire)
Installer::run();

// 4. Router
$router = new Router();

// ----------------------
// Routes principales
// ----------------------

// Accueil
$router->add('/', 'HomeController', 'index');

// ----------------------
// Authentification
// ----------------------
$router->add('/inscription', 'AuthController', 'register', 'GET');   // formulaire inscription
$router->add('/connexion', 'AuthController', 'login', 'GET');        // formulaire connexion
$router->add('/auth', 'AuthController', 'authenticate', 'POST');     // traitement connexion
$router->add('/logout', 'AuthController', 'logout', 'GET');          // déconnexion

// ----------------------
// Utilisateurs
// ----------------------
$router->add('/mon-compte', 'UserController', 'account', 'GET');     // espace perso
$router->add('/users/profil/:id', 'UserController', 'profil', 'GET');// profil public

// ----------------------
// Livres
// ----------------------
$router->add('/books', 'BookController', 'index', 'GET');            // liste des livres
$router->add('/books/:id', 'BookController', 'show', 'GET');         // détail d’un livre
$router->add('/books/edit/:id', 'BookController', 'edit', 'GET');    // formulaire édition
$router->add('/books/update/:id', 'BookController', 'update', 'POST');// traitement édition

// ----------------------
// Messagerie
// ----------------------
// 1. Page d’accueil messagerie (liste des conversations)
$router->add('/messages', 'MessageController', 'index', 'GET');

// 2. Fil de discussion (mobile ou URL directe)
$router->add('/messages/conversation/:id', 'MessageController', 'conversation', 'GET');

// 3. Envoi d’un message
$router->add('/messages/send/:id', 'MessageController', 'send', 'POST');

// ----------------------
// Dispatch
// ----------------------
$router->dispatch($_SERVER['REQUEST_URI']);
