<?php


function getComponent($type, $component): mixed {
    
    if(file_exists('resources/components/'.$type.'/' . $component . '.php')) {

        if($component == 'gallery') {
            $gallery = \App\Models\gallery::getAll(order: 'id DESC', limit: 6);
        }

        $require = require 'resources/components/'.$type.'/' . $component . '.php';
        return $require;
        
    }

    return false;
}