<?php

// Legacy function - use urlHelper.php instead
function isActive(string $dir): bool {
    if (empty($dir)) return false;

    // Use dynamic URL helper if available
    if (function_exists('getBaseUrl')) {
        $basePath = getBaseUrl();
        $onlybasePath = getBaseUrl();
    } else {
        // Fallback to dynamic detection
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || 
                  (!empty($_SERVER['REQUEST_SCHEME']) && $_SERVER['REQUEST_SCHEME'] === 'https') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $basePath = $scheme . '://' . $host;
        $onlybasePath = $basePath;
    }

    $url = $basePath . ltrim($dir, '/');
    $currentUrl = $onlybasePath . ltrim($_SERVER['REQUEST_URI'] ?? '', '/');

    if($url === $currentUrl) {
        echo 'active';
        return true;
    }
    
    return false;
}

