<?php

namespace App\Controllers;

class HomeController extends ControllerHelper
{
    public static function index(): void
    {
        parent::render(array: ['type' => 'public', 'view' => 'home/index.php', 'layoutChange' => ['pageName' => 'obaaa']]);
        
    }
}
