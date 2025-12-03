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
           // Si aucune route ne correspond → ErrorController
        $error = new ErrorController();
        $error->notFound();
        exit;
    }
}
