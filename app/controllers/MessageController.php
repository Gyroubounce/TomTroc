<?php
require_once __DIR__ . '/../managers/MessageManager.php';

class MessageController {
    public function index() {
        $manager = new MessageManager();
        $messages = $manager->findAll();
        require __DIR__ . '/../../views/messages/index.php';
    }

    public function conversation($id) {
        $manager = new MessageManager();
        $message = $manager->findById($id);
        require __DIR__ . '/../../views/messages/conversation.php';
    }
}
