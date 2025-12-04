<?php
    require __DIR__ . '/../app/core/Database.php';
    require __DIR__ . '/../app/core/Installer.php';
    require __DIR__ . '/../app/core/Router.php';

    // Exécute l’installation si nécessaire
    Installer::run();

    // Ensuite, ton router
    require __DIR__ . '/../app/controllers/HomeController.php';
    require __DIR__ . '/../app/controllers/AuthController.php';

    $router = new Router();
    $router->add('/', 'HomeController', 'index');
    $router->add('/inscription', 'AuthController', 'register');
    $router->add('/connexion', 'AuthController', 'login');

    require __DIR__ . '/../app/controllers/ErrorController.php';
    require __DIR__ . '/../app/controllers/BookController.php';

    $router->add('/books', 'BookController', 'index');
    $router->add('/books/:id', 'BookController', 'show');

    $router->dispatch($_SERVER['REQUEST_URI']);

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
