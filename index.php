<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';

//carregar Constantes
require_once __DIR__ . '/app/config/settings.php';

echo'asas';

// Carregar variáveis de ambiente (se necessário) asdda
$dotenv = Dotenv\Dotenv::createImmutable(paths: __DIR__);
$dotenv->load();

//activar reporte de erros
if (isset($_ENV['APP_DEBUG'])) {
    if ($_ENV['APP_DEBUG'] == true) {
        // Enable error reporting
        ini_set(option: 'display_errors', value: 1);
        ini_set(option: 'display_startup_errors', value: 1);
        error_reporting(error_level: E_ALL);
    }
}

// Iniciar o roteador e resolver a requisição
$router = require __DIR__ . '/app/routes/web.php';
$router->resolve();

