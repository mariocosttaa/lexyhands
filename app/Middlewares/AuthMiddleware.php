<?php

// Em app/Middlewares/AuthMiddleware.php
namespace App\Middlewares;

class AuthMiddleware
{
    private $lastUrl;

    public function __construct()
    {
        $this->lastUrl = $_SERVER['REQUEST_URI'];
    }

    public function handle()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ./login?lasturl='.$this->lastUrl.'');
            exit;
        }
    }
}
