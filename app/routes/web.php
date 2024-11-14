<?php

use App\Services\Router;

// Instanciar o roteador
$router = new Router();

// Carregar rotas públicas
require __DIR__ . '/public.php';

// Carregar rotas privadas
require __DIR__ . '/private.php';

// Retorna o roteador configurado com todas as rotas
return $router;
