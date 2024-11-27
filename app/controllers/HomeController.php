<?php

namespace App\Controllers;
use App\Models\Services as Services;
use App\Models\Products as Products;
use App\Models\Posts as Posts;

class HomeController extends ControllerHelper
{
    public static function index(): void
    {
        parent::renderView(array: ['type' => 'public', 'view' => 'home/index.php', 'layoutChange' => ['pageName' => 'Lexy Hands']], strings: [
            'services' => Services::getAll(order: 'id DESC', limit: 4),
            'products' => Products::getAll(order: 'id DESC'),
            'posts' => Posts::getAll(order: 'id DESC', limit: 3 ),
        ]);
        
    }
}
