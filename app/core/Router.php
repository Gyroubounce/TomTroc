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
        http_response_code(404);
        include __DIR__ . '/../views/errors/404.php';
        return null;
    }
}
