<?php

namespace App\Middlewares;
use App\Services\TrafficMonitor as Traffic;

class TrafficMiddlewar extends MiddlewarHelper {

    public function __construct() {
        parent::__construct();
    }

    public static function set_visitant(): void {
        (new Traffic())->logVisit();
    }


}
