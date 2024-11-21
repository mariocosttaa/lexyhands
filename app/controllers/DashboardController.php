<?php

namespace App\Controllers;

class DashboardController extends ControllerHelper{


    public static function index(): void {
        parent::renderView(array: ['type' => 'private', 'view' => 'dashboard/index.php', 'layoutChange' => ['pageName' => 'Painel de Controle']]);
    }

}