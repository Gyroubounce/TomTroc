<?php
require_once __DIR__ . '/../managers/UserManager.php';

class UserController {
    public function index() {
        $manager = new UserManager();
        $users = $manager->findAll();
        require __DIR__ . '/../../views/users/index.php';
    }
}
