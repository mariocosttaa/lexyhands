<?php

namespace App\Controllers;
use App\Services\Layout;

class ControllerHelper {

    public static function render($array = [], $strings = []): ?string {
        return Layout::render(array: $array, strings: $strings);
    }

}