<?php

class View {

    /**
     * Rend une vue avec un header et un footer
     */
    public static function render(string $template, array $data = []): void
    {
        $viewPath = __DIR__ . '/../views/' . $template . '.php';
        $header   = __DIR__ . '/../views/partials/header.php';
        $footer   = __DIR__ . '/../views/partials/footer.php';

        if (!file_exists($viewPath)) {
            throw new Exception("Vue introuvable : $template");
        }

        extract($data, EXTR_SKIP); // évite d'écraser des variables internes

        require $header;
        require $viewPath;
        require $footer;
    }

    /**
     * Rend une vue sans layout (utile pour AJAX ou pages spéciales)
     */
    public static function renderPartial(string $template, array $data = []): void
    {
        $viewPath = __DIR__ . '/../views/' . $template . '.php';

        if (!file_exists($viewPath)) {
            throw new Exception("Vue introuvable : $template");
        }

        extract($data, EXTR_SKIP);
        require $viewPath;
    }
}
