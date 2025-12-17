<?php

class HomeController {
    private $bookManager;
    private $userManager;

    public function __construct() {
        $this->bookManager = new BookManager();
        $this->userManager = new UserManager();
    }


    public function index() {

        $books = $this->bookManager->findLatest(4);

        View::render('home/index', ['books' => $books]);
    }
}
