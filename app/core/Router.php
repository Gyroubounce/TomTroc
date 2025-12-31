<?php

class Router {
    private array $routes = [];

    /**
     * Ajoute une route au routeur
     */
    public function add(string $path, string $controller, string $method, string $httpMethod = 'GET'): void
    {
        $this->routes[] = [
            'path'       => rtrim($path, '/'),
            'controller' => $controller,
            'method'     => $method,
            'httpMethod' => strtoupper($httpMethod)
        ];
    }

    /**
     * Analyse l'URL et appelle le bon contrôleur
     */
    public function dispatch(string $uri): mixed
    {
        $path = rtrim(parse_url($uri, PHP_URL_PATH), '/');
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {

            // Support des paramètres dynamiques :id
            $pattern = preg_replace('#:([a-zA-Z_]+)#', '([0-9]+)', $route['path']);

            if (preg_match('#^' . $pattern . '$#', $path, $matches)
                && $route['httpMethod'] === $requestMethod) {

                $controllerName = $route['controller'];

                if (!class_exists($controllerName)) {
                    throw new Exception("Contrôleur introuvable : $controllerName");
                }

                $controller = new $controllerName();

                if (!method_exists($controller, $route['method'])) {
                    throw new Exception("Méthode introuvable : {$route['method']} dans $controllerName");
                }

                // Retire le premier élément (la route complète)
                array_shift($matches);

                return call_user_func_array([$controller, $route['method']], $matches);
            }
        }

        // 404
        $error = new ErrorController();
        return $error->notFound();
    }
}
