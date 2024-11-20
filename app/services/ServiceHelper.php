<?php

namespace App\Services;
use App\Config\Database;

class ServiceHelper {

    public function __construct()
    {
         //
    }

    

    public static function conn(): \PDO|null {
        $db = new Database();
        return $db->conn();
    }

    public static function ROOT_PATH(): string {
        //2 pois ele está dentro de App, ENTÃO COM ISSO ELE RETORNA A RAIZ
        return dirname(path: __DIR__, levels: 2);
    }

}