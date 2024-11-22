<?php 

namespace App\Controllers;

class Services extends ControllerHelper
{
    public static function index(): void
    {
        parent::renderView(array: ['type' => 'public', 'view' => 'services/services.php', 'layoutChange' => ['pageName' => 'Serviços']]);
    }
}