<?php


function isActive(string $dir): bool {
    if (empty($dir)) return false;

    $host = $_SERVER['HTTP_HOST'];
    $basePath = ($_SERVER['REQUEST_SCHEME'] === 'https' ? 'https://' : 'http://') . $host;
    if (strpos($host, 'localhost') !== false) {
        $basePath = 'http://localhost/projects/lexyhands/';
        $onlybasePath = 'http://localhost/';
    }

    $url = $basePath . ltrim($dir, '/');
    $currentUrl =  $onlybasePath . ltrim($_SERVER['REQUEST_URI'], '/');


    if($url === $currentUrl) echo 'active'; return true;
    
    return false;
}

