<?php


$router->post(uri: '/auth/connect', action: [
    App\Controllers\AuthController::class, 'connect'
]);   

$router->get(uri: '/auth/login', action: [ App\Controllers\LoginController::class, 'index'], 
    middlewares: [[[App\Middlewares\TrafficMiddlewar::class, 'set_visitant']]]
);      

$router->get(uri: '/auth/logout', action: [ 
    App\Controllers\AuthController::class, 'logout'],
    middlewares: [[App\Middlewares\TrafficMiddlewar::class, 'set_visitant']], //fazer o monitoramente de visitantes
);      



// Página inicial pública
$router->get(uri: '', action: [
    App\Controllers\HomeController::class, 'index'],
    middlewares: [[App\Middlewares\TrafficMiddlewar::class, 'set_visitant']]
);       

$router->get(uri: '/services', action: [
    App\Controllers\ServicesController::class, 'index'],
    middlewares: [[App\Middlewares\TrafficMiddlewar::class, 'set_visitant']], //fazer o monitoramente de visitantes
); 

$router->get(uri: '/service/{slugName}', action: [
    App\Controllers\ServicesController::class, 'view'],
    middlewares: [[App\Middlewares\TrafficMiddlewar::class, 'set_visitant']], //fazer o monitoramente de visitantes
); 

$router->get(uri: '/posts', action: [
    App\Controllers\PostsController::class, 'index'],
    middlewares: [[App\Middlewares\TrafficMiddlewar::class, 'set_visitant']], //fazer o monitoramente de visitantes
); 

$router->get(uri: '/posts/tags', action: [
    App\Controllers\PostsController::class, 'tags'],
    middlewares: [[App\Middlewares\TrafficMiddlewar::class, 'set_visitant']], //fazer o monitoramente de visitantes
); 

$router->get(uri: '/posts/tags/{name}', action: [
    App\Controllers\PostsController::class, 'tagsView'],
    middlewares: [[App\Middlewares\TrafficMiddlewar::class, 'set_visitant']], //fazer o monitoramente de visitantes
); 

$router->get(uri: '/posts/categories', action: [
    App\Controllers\PostsController::class, 'categories'],
    middlewares: [[App\Middlewares\TrafficMiddlewar::class, 'set_visitant']], //fazer o monitoramente de visitantes
); 

$router->get(uri: '/posts/categories/{identificator}', action: [
    App\Controllers\PostsController::class, 'categorysView'],
    middlewares: [[App\Middlewares\TrafficMiddlewar::class, 'set_visitant']], //fazer o monitoramente de visitantes
); 


$router->get(uri: '/posts/{identificator}/{date}/{id}', action: [
    App\Controllers\PostsController::class, 'view'],
    middlewares: [[App\Middlewares\TrafficMiddlewar::class, 'set_visitant']], //fazer o monitoramente de visitantes
); 









// Página inicial pública
$router->get(uri: '/about', action: [
    App\Controllers\HomeController::class, 'index'
]);    

$router->get(uri: '/test', action: [
    \App\Controllers\TestController::class, 'index'
]);
$router->post(uri: '/test', action: [
    \App\Controllers\TestController::class, 'index'
]);




return $router;
