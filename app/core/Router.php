<?php
class Router {
    private $routes = [];

    public function add($path, $controller, $method) {
        $this->routes[$path] = [$controller, $method];
    }

    public function dispatch($uri) {
        $path = parse_url($uri, PHP_URL_PATH);
        
        if (isset($this->routes[$path])) {
            [$controller, $method] = $this->routes[$path];
            $instance = new $controller();
            return $instance->$method();
        }
            foreach ($this->routes as $route => [$controller, $method]) {
        $pattern = preg_replace('#:id#', '([0-9]+)', $route);
        if (preg_match('#^' . $pattern . '$#', $path, $matches)) {
            $instance = new $controller();
            if (isset($matches[1])) {
                $instance->$method($matches[1]); // passe l’ID
            } else {
                $instance->$method();
            }
            return;
        }
    }
           // Si aucune route ne correspond → ErrorController
        $error = new ErrorController();
        $error->notFound();
        exit;
    }
}
