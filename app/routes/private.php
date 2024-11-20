<?php

//rota de admin
$router->get('/admin/dashboard', [ 
App\Controllers\HomeController::class, 'index'], [
    [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);



return $router;
