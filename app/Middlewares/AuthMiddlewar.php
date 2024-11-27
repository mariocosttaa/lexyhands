<?php

namespace App\Middlewares;
use App\Services\Notification as Notification;

class AuthMiddlewar extends MiddlewarHelper
{
    private $lastUrl;

    public function __construct()
    {
        $this->lastUrl = $_SERVER['REQUEST_URI'];
    }

    public function onlyLogin(): void
    {
        if (!isset($_SESSION['auth'])) {
            header('Location: ../auth/login?continue='.$this->lastUrl.'');
            exit;
        }
    }

    public function redirectIfLogin(): void {
        if (isset($_SESSION['auth'])) {
            Notification::notify(
                title: 'Você Já Está Conectado',
                 message: false, 
                 level: 'info', 
                 type: 'sweetalert', 
                 position: 'top-end', 
                 redirectUrl: '/../admin/dashboard');  
            exit();
        }
    }
}
