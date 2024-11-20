<?php

//VARIAVEIS GLOBAIS DE ACESSO A TODO PROJECTO
$array = [
    'ROOT_PATH' => dirname(path: __DIR__),
    'Gallery' => \App\Models\gallery::getAll(order: 'id DESC', limit: 5),
];

$_GLOBAL =  (object) $array;

