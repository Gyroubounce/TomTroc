<?php
/**
 * Autoload maison pour charger automatiquement les classes
 * depuis app/core, app/controllers, app/managers, app/models
 */

spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/../core/',
        __DIR__ . '/../controllers/',
        __DIR__ . '/../managers/',
        __DIR__ . '/../models/',
    ];

    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require $file;
            return;
        }
    }
});
