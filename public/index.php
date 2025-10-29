<?php

session_start();

//activar reporte de erros
if (isset($_ENV['APP_DEBUG'])) {
    if ($_ENV['APP_DEBUG'] == true) {
        // Enable error reporting
        ini_set(option: 'display_errors', value: 1);
        ini_set(option: 'display_startup_errors', value: 1);
        error_reporting(error_level: E_ALL);
    }
}

//carregar Constantes
require_once __DIR__ . '/../vendor/autoload.php';

// Iniciar o roteador e resolver a requisição
$router = require __DIR__ . '/../app/routes/web.php';
$router->resolve();

//emitir alertas isso aqui é para verifciar na ultima sessao ao redirecionar a pagia se tem alguma notificação
$notification  = (new \App\Services\Notification())->autoDisplayNotification();
