<?php
// Em App/Services/Router.php

namespace App\Services;

class Router
{
    private $routes = [];
    private $currentUri;
    private $logger;
    private $startTime;

    public function __construct()
    {
        $this->startTime = microtime(true);
        $this->logger = new Logger();

        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../'); // Caminho correto para a raiz do projeto
        $dotenv->load();

        $this->currentUri = rtrim($_SERVER['REQUEST_URI'] ?? '/', '/');

        if (isset($_SERVER['HTTP_HOST']) && strpos($_SERVER['HTTP_HOST'], 'localhost') !== false && ($_ENV['APP_ENV'] ?? '') === 'local') {
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
        $uri = strtok($this->currentUri, '?') ?: '/';
        $httpMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $statusCode = 200;
        $error = null;
    
        try {
            // Check if routes exist for this HTTP method
            if (!isset($this->routes[$httpMethod])) {
                throw new \Exception("No routes defined for method: $httpMethod");
            }
            
            foreach ($this->routes[$httpMethod] as $routeUri => $route) {
                // Normalize empty route to match root
                $normalizedRouteUri = $routeUri === '' ? '/' : $routeUri;
                
                // Cria um padrão para capturar parâmetros dinâmicos
                $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_-]+)', $normalizedRouteUri);
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
        
                    // Log successful request
                    $executionTime = microtime(true) - $this->startTime;
                    $this->logger->logRequest($httpMethod, $uri, $statusCode, $executionTime);
                    return true;
                }
            }
            
            // No route found - 404
            $statusCode = 404;
            $executionTime = microtime(true) - $this->startTime;
            $this->logger->logRequest($httpMethod, $uri, $statusCode, $executionTime, 'Route not found');
            
            // Render 404 page
            \App\Controllers\ControllerHelper::render404();
            return false;
            
        } catch (\Throwable $e) {
            // Log error
            $statusCode = 500;
            $executionTime = microtime(true) - $this->startTime;
            $error = $e->getMessage();
            $this->logger->logError($error, $e->getTraceAsString());
            $this->logger->logRequest($httpMethod, $uri, $statusCode, $executionTime, $error);
            
            // Re-throw if in debug mode, otherwise show generic error
            if (isset($_ENV['APP_DEBUG']) && $_ENV['APP_DEBUG'] === 'true') {
                throw $e;
            } else {
                http_response_code(500);
                echo "An error occurred. Please check the logs.";
            }
            return false;
        }
    }
    
    
    

    public function getCurrentUri()
    {
        return $this->currentUri;
    }
}
