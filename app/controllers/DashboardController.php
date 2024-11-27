<?php

namespace App\Controllers;
use App\Models\Products as Products;
use App\Models\Posts as Posts;

use App\Services\TrafficMonitor as Traffic;
class DashboardController extends ControllerHelper{


    public static function index(): void {
        parent::renderView(array: ['type' => 'private', 'view' => 'dashboard/index.php', 'layoutChange' => ['pageName' => 'Painel de Controle']], strings: [
            'products' => Products::countAll(),
            'posts' => Posts::countAll(),
            'todayTraffic' => Traffic::todayAccess(),
        ]);
    }

}