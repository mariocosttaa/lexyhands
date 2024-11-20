<?php

namespace App\Controllers;

class LoginController extends ControllerHelper {

    public function index(): void {
        parent::renderView(array: ['type' => 'public', 'components' => false, 'view' => 'login/index.php', 'layoutChange' => ['pageName' => 'Lexy Hands']], strings: [
            'settings' => parent::settings(),
        ]);
    }


    


}