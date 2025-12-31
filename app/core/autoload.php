<?php
/**
 * Autoload maison pour charger automatiquement les classes
 * depuis app/core, app/controllers, app/managers, app/models.
 *
 * Fonctionnement :
 * - Lorsqu'une classe est instanciée, PHP appelle automatiquement cette fonction.
 * - On parcourt les dossiers définis dans $paths.
 * - Si un fichier correspondant au nom de la classe existe, on le charge.
 */

spl_autoload_register(function (string $class): void {

    $paths = [
        __DIR__ . '/../core/',
        __DIR__ . '/../controllers/',
        __DIR__ . '/../managers/',
        __DIR__ . '/../models/',
        __DIR__ . '/../services/',
    ];

    foreach ($paths as $path) {
        $file = $path . $class . '.php';

        if (is_file($file)) {
            require_once $file;
            return;
        }
    }

    // Optionnel : message utile en développement
    if (isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] === 'local') {
        throw new Exception("Impossible de charger la classe : $class");
    }
});
