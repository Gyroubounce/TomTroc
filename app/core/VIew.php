<?php

class View {
    public static function render(string $template, array $data = []) {
        extract($data); // rend les variables accessibles dans la vue
        require __DIR__ . '/../views/partials/header.php';
        require __DIR__ . '/../views/' . $template . '.php';
        require __DIR__ . '/../views/partials/footer.php';
    }
}
