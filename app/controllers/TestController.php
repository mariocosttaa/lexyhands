<?php 

namespace App\Controllers;

class TestController extends ControllerHelper {

    public static function index(): void {
        parent::renderView(array: ['type' => 'public', 'components' => false, 'view' => 'tests.php', 'layoutChange' => ['pageName' => 'Lexy Hands']]);
    }
}