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


//DEFINIÇÕES

$router->get(uri: '/admin/settings', action: [ 
    App\Controllers\SettingsAdminController::class, 'index'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->post(uri: '/admin/settings/general', action: [ 
    App\Controllers\SettingsAdminController::class, 'general'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->post(uri: '/admin/settings/logos', action: [ 
    App\Controllers\SettingsAdminController::class, 'logos'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->post(uri: '/admin/settings/social-media', action: [ 
    App\Controllers\SettingsAdminController::class, 'social_media'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);








//SERVIÇOS
    
$router->get(uri: '/admin/services/create', action: [ 
    App\Controllers\ServicesAdminController::class, 'create'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->post(uri: '/admin/services/create', action: [ 
    App\Controllers\ServicesAdminController::class, 'create_post'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->get(uri: '/admin/services/edit/{slugName}', action: [ 
    App\Controllers\ServicesAdminController::class, 'edit'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->post(uri: '/admin/services/edit/{slugName}', action: [ 
    App\Controllers\ServicesAdminController::class, 'edit_post'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->post(uri: '/admin/services/delete/{slugName}', action: [ 
    App\Controllers\ServicesAdminController::class, 'delete'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->get(uri: '/admin/services', action: [ 
    App\Controllers\ServicesAdminController::class, 'index'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);






//POSTS

$router->get(uri: '/admin/posts/create', action: [ 
    App\Controllers\PostsAdminController::class, 'create'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->post(uri: '/admin/posts/create', action: [ 
    App\Controllers\PostsAdminController::class, 'create_post'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->get(uri: '/admin/posts/edit/{identificator}', action: [ 
    App\Controllers\PostsAdminController::class, 'edit'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->post(uri: '/admin/posts/edit/{identificator}', action: [ 
    App\Controllers\PostsAdminController::class, 'edit_post'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->get(uri: '/admin/posts/delete/file/{fileKey}/{identificator}', action: [ 
    App\Controllers\PostsAdminController::class, 'fileDelete'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->get(uri: '/admin/posts/delete/video/{identificator}', action: [ 
    App\Controllers\PostsAdminController::class, 'videoDelete'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->get(uri: '/admin/posts/delete/{identificator}', action: [ 
    App\Controllers\PostsAdminController::class, 'delete'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->post(uri: '/admin/posts/delete/{identificator}', action: [ 
    App\Controllers\PostsAdminController::class, 'delete'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->get(uri: '/admin/posts', action: [ 
    App\Controllers\PostsAdminController::class, 'index'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);
    





//CATEGORIAS

$router->get(uri: '/admin/posts/categories/create', action: [ 
    App\Controllers\CategoriesAdminController::class, 'create'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->post(uri: '/admin/posts/categories/create', action: [ 
    App\Controllers\CategoriesAdminController::class, 'create_post'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->get(uri: '/admin/posts/categories/edit/{identificator}', action: [ 
    App\Controllers\CategoriesAdminController::class, 'edit'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->post(uri: '/admin/posts/categories/edit/{identificator}', action: [ 
    App\Controllers\CategoriesAdminController::class, 'edit_post'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->post(uri: '/admin/posts/categories/delete/{identificator}', action: [ 
    App\Controllers\CategoriesAdminController::class, 'delete'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->get(uri: '/admin/posts/categories', action: [ 
    App\Controllers\CategoriesAdminController::class, 'index'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);




//PRODUCTOS

$router->get(uri: '/admin/products', action: [ 
    App\Controllers\ProductsAdminController::class, 'index'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->get(uri: '/admin/products/create', action: [ 
    App\Controllers\ProductsAdminController::class, 'create'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->post(uri: '/admin/products/create', action: [ 
    App\Controllers\ProductsAdminController::class, 'create_post'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->get(uri: '/admin/products/edit/{identificator}', action: [ 
    App\Controllers\ProductsAdminController::class, 'edit'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->post(uri: '/admin/products/edit/{identificator}', action: [ 
    App\Controllers\ProductsAdminController::class, 'edit_post'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->post(uri: '/admin/products/delete/{identificator}', action: [ 
    App\Controllers\ProductsAdminController::class, 'delete'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);

$router->get(uri: '/admin/products/delete/file/{fileKey}/{identificator}', action: [ 
    App\Controllers\ProductsAdminController::class, 'filesDelete'], middlewares: [
        [App\Middlewares\AuthMiddlewar::class, 'onlyLogin'],
]);






return $router;
