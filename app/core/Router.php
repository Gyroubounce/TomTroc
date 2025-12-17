<?php
class Router {
    private $routes = [];

    public function add($path, $controller, $method, $httpMethod = 'GET') {
        $this->routes[] = [
            'path'       => $path,
            'controller' => $controller,
            'method'     => $method,
            'httpMethod' => strtoupper($httpMethod)
        ];
    }

    public function dispatch($uri) {
        $path = parse_url($uri, PHP_URL_PATH);
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            $pattern = preg_replace('#:id#', '([0-9]+)', $route['path']);

            if (preg_match('#^' . $pattern . '$#', $path, $matches) && $route['httpMethod'] === $requestMethod) {
                $instance = new $route['controller']();
                if (isset($matches[1])) {
                    return $instance->{$route['method']}($matches[1]);
                }
                return $instance->{$route['method']}();
            }
        }

        $error = new ErrorController();
        $error->notFound();
        exit;
    }
}
