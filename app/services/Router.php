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

    public function post($uri, $action, $middlewares = [])
    {
        $this->routes['POST'][$uri] = [
            'action' => $action,
            'middlewares' => $middlewares,
        ];
    }

    public function resolve(): bool
    {
        // Obtém a URI sem a query string
        $uri = strtok($this->currentUri, '?');
        $method = $_SERVER['REQUEST_METHOD'];
    
        foreach ($this->routes[$method] as $routeUri => $route) {
            // Cria um padrão para capturar parâmetros dinâmicos
            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_-]+)', $routeUri);
            $pattern = "#^" . $pattern . "$#";
    
            if (preg_match($pattern, $uri, $matches)) {
                // Filtra os parâmetros dinâmicos (somente grupos nomeados)
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
    
                // Executa cada middleware
                foreach ($route['middlewares'] as $middleware) {
                    $middlewareClass = $middleware[0];
                    $middlewareMethod = $middleware[1];
    
                    // Instancia a classe do middleware e chama o método especificado
                    $middlewareInstance = new $middlewareClass;
                    $middlewareInstance->$middlewareMethod($params);  // Passa os parâmetros se necessário
                }
    
                // Chama a ação e passa os parâmetros diretamente como argumentos
                if (is_array($route['action'])) {
                    [$class, $method] = $route['action'];
                    call_user_func_array([new $class, $method], $params);
                } else {
                    call_user_func_array($route['action'], $params);
                }
    
                return true;
            }
        }
    
        echo "Página não encontrada";
        return false;
    }
    
    
    

    public function getCurrentUri()
    {
        return $this->currentUri;
    }
}
