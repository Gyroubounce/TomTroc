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

// Formulaire inscription
$router->add('/inscription', 'AuthController', 'register', 'GET');

// Traitement inscription (ROUTE MANQUANTE → AJOUTÉE)
$router->add('/users/storeRegister', 'AuthController', 'storeRegister', 'POST');

// Formulaire connexion
$router->add('/connexion', 'AuthController', 'login', 'GET');

// Traitement connexion
$router->add('/auth', 'AuthController', 'authenticate', 'POST');

// Déconnexion
$router->add('/logout', 'AuthController', 'logout', 'GET');

// ----------------------
// Utilisateurs
// ----------------------
$router->add('/mon-compte', 'UserController', 'account', 'GET');
$router->add('/users/profil/:id', 'UserController', 'profil', 'GET');
$router->add('/users/update/:id', 'UserController', 'update', 'POST');

// ----------------------
// Livres
// ----------------------
$router->add('/books', 'BookController', 'index', 'GET');
$router->add('/books/:id', 'BookController', 'show', 'GET');

# --- Création ---
$router->add('/books/create', 'BookController', 'create', 'GET');
$router->add('/books/store', 'BookController', 'store', 'POST');

# --- Edition ---
$router->add('/books/edit/:id', 'BookController', 'edit', 'GET');
$router->add('/books/update/:id', 'BookController', 'update', 'POST');

# --- Mise à jour de l’image ---
$router->add('/books/update-image/:id', 'BookController', 'updateImage', 'POST');

# --- Suppression ---
$router->add('/books/delete/:id', 'BookController', 'delete', 'GET');


// ----------------------
// Messagerie
// ----------------------

// Liste des conversations
$router->add('/messages', 'MessageController', 'index', 'GET');

// Ouvrir une conversation
$router->add('/messages/conversation/:id', 'MessageController', 'conversation', 'GET');

// Démarrer une conversation depuis un livre (crée un message auto)
$router->add('/messages/start/:id', 'MessageController', 'start', 'GET');

// Envoyer un message dans une conversation
$router->add('/messages/send/:id', 'MessageController', 'sendTo', 'POST');
$router->add('/messages/send-to/:id', 'MessageController', 'sendTo', 'POST');

// ----------------------
// Pages statiques
// ----------------------
$router->add('/confidentialite', 'StaticController', 'confidentialite', 'GET');
$router->add('/mentions-legales', 'StaticController', 'mentionsLegales', 'GET');


// ----------------------
// Dispatch
// ----------------------
$router->dispatch($_SERVER['REQUEST_URI']);
