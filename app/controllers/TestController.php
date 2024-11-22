<?php

namespace App\Controllers;
use App\Services\FileUpload;

class TestController extends ControllerHelper {


    public function index() {
        parent::renderView(array: ['type' => 'private', 'components' => false, 'view' => 'test/index.php', 'layoutChange' => ['pageName' => 'Teste']]);
    }

}