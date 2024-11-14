<?php

//rota de admin
$router->get('/admin', [ App\Controllers\HomeController::class, 'index'], [
    App\Middlewares\AuthMiddleware::class,
    //App\Middlewares\RateLimitMiddleware::class,
]);



return $router;
