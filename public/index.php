<?php

// Start timing
$requestStartTime = microtime(true);

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

// Setup error handler to log PHP errors
$logger = new \App\Services\Logger();
set_error_handler(function($errno, $errstr, $errfile, $errline) use ($logger) {
    $logger->logError("PHP Error [{$errno}]: {$errstr} in {$errfile} on line {$errline}");
    return false; // Let PHP continue with default error handling
});

// Setup exception handler
set_exception_handler(function($exception) use ($logger) {
    $logger->logError(
        "Uncaught Exception: " . $exception->getMessage(),
        $exception->getTraceAsString()
    );
    http_response_code(500);
    if (isset($_ENV['APP_DEBUG']) && $_ENV['APP_DEBUG'] === 'true') {
        echo "<h1>Error</h1><pre>" . $exception->getMessage() . "\n" . $exception->getTraceAsString() . "</pre>";
    } else {
        echo "An error occurred. Please check the logs.";
    }
});

// Setup shutdown function to catch fatal errors
register_shutdown_function(function() use ($logger) {
    $error = error_get_last();
    if ($error !== null && in_array($error['type'], [E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_PARSE])) {
        $logger->logError(
            "Fatal Error: {$error['message']} in {$error['file']} on line {$error['line']}"
        );
    }
});

// Iniciar o roteador e resolver a requisição
$router = require __DIR__ . '/../app/routes/web.php';
$router->resolve();

//emitir alertas isso aqui é para verifciar na ultima sessao ao redirecionar a pagia se tem alguma notificação
$notification  = (new \App\Services\Notification())->autoDisplayNotification();
