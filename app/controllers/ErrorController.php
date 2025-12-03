<?php
class ErrorController {
    public function notFound() {
        http_response_code(404);
        include __DIR__ . '/../views/partials/header.php';
        include __DIR__ . '/../views/errors/404.php';
        include __DIR__ . '/../views/partials/footer.php';
    }
}
