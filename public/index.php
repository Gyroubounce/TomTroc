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

// Définition des routes
$router->add('/', 'HomeController', 'index');

// Authentification
$router->add('/inscription', 'AuthController', 'register');
$router->add('/connexion', 'AuthController', 'login', 'GET');   // affiche le formulaire
$router->add('/auth', 'AuthController', 'authenticate', 'POST'); // traite le formulaire
$router->add('/logout', 'AuthController', 'logout', 'GET');      // déconnexion

// Mon compte
$router->add('/mon-compte', 'UserController', 'account');

// Livres
$router->add('/books', 'BookController', 'index');
$router->add('/books/:id', 'BookController', 'show');

// 5. Dispatch
$router->dispatch($_SERVER['REQUEST_URI']);
