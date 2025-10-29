<?php

/**
 * Get the base URL of the application
 */
function getBaseUrl(): string {
    // Get the base path from APP_URL if set, otherwise auto-detect
    if (isset($_ENV['APP_URL']) && !empty($_ENV['APP_URL'])) {
        return rtrim($_ENV['APP_URL'], '/');
    }
    
    // Handle CLI environment
    if (php_sapi_name() === 'cli') {
        return 'http://localhost';
    }
    
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    
    // Auto-detect base path
    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '/';
    $basePath = dirname($scriptName);
    
    // If we're in a subdirectory, include it
    if ($basePath !== '/' && $basePath !== '\\') {
        return $protocol . '://' . $host . $basePath;
    }
    
    return $protocol . '://' . $host;
}

/**
 * Generate a full URL for a given path
 */
function url(string $path = ''): string {
    $baseUrl = getBaseUrl();
    $path = ltrim($path, '/');
    
    if (empty($path)) {
        return $baseUrl;
    }
    
    return $baseUrl . '/' . $path;
}

/**
 * Generate a URL for assets
 */
function asset(string $path): string {
    return url('assets/' . ltrim($path, '/'));
}

/**
 * Generate a URL for the public directory
 */
function publicUrl(string $path = ''): string {
    return url('public/' . ltrim($path, '/'));
}

/**
 * Check if current URL matches the given path
 */
function isUrlActive(string $path): bool {
    $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $checkPath = parse_url(url($path), PHP_URL_PATH);
    
    return $currentPath === $checkPath;
}

/**
 * Get the current URL
 */
function currentUrl(): string {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    return $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

/**
 * Redirect to a URL
 */
function redirect(string $path): void {
    header('Location: ' . url($path));
    exit;
}
