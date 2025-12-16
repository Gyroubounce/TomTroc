<?php

require_once __DIR__ . '/../managers/BookManager.php';
class HomeController {
    private $bookManager;
    private $userManager;

    public function __construct() {
        $this->bookManager = new BookManager();
        $this->userManager = new UserManager();
    }


    public function index() {

        $books = $this->bookManager->findLatest(4);
        
        include __DIR__ . '/../views/partials/header.php';
        include __DIR__ . '/../views/home/index.php';
        include __DIR__ . '/../views/partials/footer.php';
    }
}
