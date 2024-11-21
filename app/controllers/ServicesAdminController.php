<?php

namespace App\Controllers;


class ServicesAdminController extends ServicesController
{
    public static function index(): void
    {
        parent::renderView(array: ['type' => 'private', 'view' => 'services/index.php', 'layoutChange' => ['pageName' => 'Serviços']], strings: [
            'services' => \App\Models\services::getAll(order: 'id DESC'),
        ]);
    }

    public static function create(): void {
        parent::renderView(array: ['type' => 'private', 'view' => 'services/create.php', 'layoutChange' => ['pageName' => 'Serviços']]);
    }
}