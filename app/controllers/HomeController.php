<?php

namespace App\Controllers;
use App\Models\services as Services;
use App\Models\products as Products;
use App\Models\posts as Posts;

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
