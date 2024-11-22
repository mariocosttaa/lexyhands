<?php


$router->post(uri: '/auth/connect', action: [
    App\Controllers\AuthController::class, 'connect'
]);   

$router->get(uri: '/auth/login', action: [ App\Controllers\LoginController::class, 'index'], middlewares: [
    [App\Middlewares\AuthMiddlewar::class, 'redirectIfLogin'], //redirecionar se tiver logado...
]);      

$router->get(uri: '/auth/logout', action: [ 
    App\Controllers\AuthController::class, 'logout'
]);      



// Página inicial pública
$router->get(uri: '', action: [
    App\Controllers\HomeController::class, 'index'
]);      

$router->get(uri: '/services', action: [
    App\Controllers\ServicesController::class, 'index'
]);      

$router->get(uri: '/service/{slugName}', action: [
    App\Controllers\ServicesController::class, 'view'
]);

$router->get(uri: '/posts', action: [
    App\Controllers\PostsController::class, 'index'
]);

$router->get(uri: '/posts/tags', action: [
    App\Controllers\PostsController::class, 'tags'
]);

$router->get(uri: '/posts/tags/{name}', action: [
    App\Controllers\PostsController::class, 'tagsView'
]);

$router->get(uri: '/posts/categories', action: [
    App\Controllers\PostsController::class, 'categories'
]);

$router->get(uri: '/posts/categories/{name}/{id}', action: [
    App\Controllers\PostsController::class, 'categorysView'
]);


$router->get(uri: '/posts/{identificator}/{date}/{id}', action: [
    App\Controllers\PostsController::class, 'view'
]);









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
