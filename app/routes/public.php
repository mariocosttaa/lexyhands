<?php



// Página inicial pública
$router->get('', [
    App\Controllers\HomeController::class, 'index'
]);      

// Página inicial pública
$router->get('/login', [
    App\Controllers\HomeController::class, 'index'
]);    


// Página inicial pública
$router->get('/about', [
    App\Controllers\HomeController::class, 'index'
]);    

return $router;
