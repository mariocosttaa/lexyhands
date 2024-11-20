<?php

use App\Services\SlugGenerator;

function slug(string $string): string {
    if(empty($string)) return false;
    return (new SlugGenerator())->generate(string: $string);
}

function deslug(string $string): string {
    if(empty($string)) return false;
    return (new SlugGenerator())->generate(string: $string);
}