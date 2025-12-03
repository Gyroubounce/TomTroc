<?php
require_once __DIR__ . '/../managers/BookManager.php';

class BookController {
    public function index() {
        $manager = new BookManager();
        $books = $manager->findAll();
        include __DIR__ . '/../views/partials/header.php';
        include __DIR__ . '/../views/books/index.php';
        include __DIR__ . '/../views/partials/footer.php';
    }
}
