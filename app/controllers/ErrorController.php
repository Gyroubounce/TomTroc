<?php
/**
 * Contrôleur des erreurs.
 * Affiche la page 404 via View::render().
 */
class ErrorController {
    public function notFound(): void
    {
        http_response_code(404);
        View::render('errors/404');
    }
}
