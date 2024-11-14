<?php
// Em App/Services/Router.php

namespace App\Services;

class Router
{
    private $routes = [];
    private $currentUri;

    public function __construct()
    {
        $this->currentUri = rtrim($_SERVER['REQUEST_URI'], '/');

        if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false && $_ENV['APP_ENV'] === 'local') {
            $baseUri = '/projects/lexyhands';
            if (strpos($this->currentUri, $baseUri) === 0) {
                $this->currentUri = substr($this->currentUri, strlen($baseUri));
            }
        }
    }

    public function get($uri, $action, $middlewares = [])
    {
        $this->routes['GET'][$uri] = [
            'action' => $action,
            'middlewares' => $middlewares,
        ];
    }

    public function resolve(): bool
    {
        $uri = $this->currentUri;
        $method = $_SERVER['REQUEST_METHOD'];

        if (isset($this->routes[$method][$uri])) {
            $route = $this->routes[$method][$uri];

            // Executa cada middleware antes de chamar a ação principal
            foreach ($route['middlewares'] as $middleware) {
                $middlewareInstance = new $middleware;
                $middlewareInstance->handle();
            }

            call_user_func(callback: $route['action']);

            return true;
        } else {
            echo "Página não encontrada";
            return false;
        }
    }

    public function getCurrentUri()
    {
        return $this->currentUri;
    }
}
