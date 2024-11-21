<?php

//ROTAS PRINCIPAIS

$router->get(uri: '/admin/dashboard', action: [ 
App\Controllers\DashboardController::class, 'index'], middlewares: [
    [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->get(uri: '/admin', action: [ 
    App\Controllers\DashboardController::class, 'index'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);


//SERVIÇOS
    
$router->get(uri: '/admin/services/create', action: [ 
    App\Controllers\ServicesAdminController::class, 'create'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->get(uri: '/admin/services/create/post', action: [ 
    App\Controllers\ServicesAdminController::class, 'create'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->get(uri: '/admin/services', action: [ 
    App\Controllers\ServicesAdminController::class, 'index'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);
    


return $router;
