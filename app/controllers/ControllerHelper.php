<?php

namespace App\Controllers;
use App\Services\Layout;
use App\Config\Database;
use App\Services\SqlEasy;
use App\Services\UserDate;
use App\Services\Notification;
use App\Models\Users;
class ControllerHelper {
    
    public static function notification(
        string $title,
        ?string $message = null,
        ?string $level = 'info',
        ?string $type = 'sweetalert',
        ?string $position = 'top-end',
        ?int $timeout = 3000,
        ?string $redirectUrl = null
    ): void {
        Notification::notify(title: $title, message: $message, level: $level, type: $type, position: $position, timeout: $timeout, redirectUrl: $redirectUrl);
    }
    
    public static function settings(): object{
        $sql = new SqlEasy();
        return $sql->select(table: 'settings', where: null, limit: 1, order: null, object: true);
    }

    public static function conn(): \PDO|null {
        return Database::conn();
    }

    public static function renderView($array = [], $strings = []): ?string {
        //inclur as strings globais
        $strings = self::globalStrings($strings);

        return Layout::render(array: $array, strings: $strings);
    }
    public static function render404(): void {
        echo 'A Pagina não foi encontrada ou nao existe..';
        exit();
    }

    public static function renderAdmin404(): void {
        echo 'A Pagina não foi encontrada ou nao existe..';
        exit();
    }


    public static function renderErrorPage(?string $message = null): void {
        echo $message ?: 'A Pagina não foi encontrada';
        exit();
    }

    public static function userDateTime($date, $order): string {
        $userDate = new UserDate();
        return $userDate->userDateTime(utcDate: $date, format: $order);
    }


    public static function User(): mixed {
        return self::getUserLoggin();
    }
    
    private static function globalStrings(?array $strings = []): array {

        $strings['main'] = (object) [
            'currentUrl' => $_SERVER['REQUEST_URI'],
            'user' => self::getUserLoggin() ?: false,
            'settings' => self::settings()
        ];
        
        return $strings;
    }

    private static function getUserLoggin(): mixed {
        if (isset($_SESSION['auth'])) {
            $user = Users::getByUserId(user_id: $_SESSION['auth']);
            if($user) return $user;
        }
        return false;
    }

}